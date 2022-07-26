<?php

namespace frontend\controllers;

use common\models\Album;
use common\models\AlbumGenre;
use common\models\EditSubmission;
use common\models\FeaturedAuthor;
use common\models\Track;
use JetBrains\PhpStorm\ArrayShape;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class SubmissionController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['submissionPanel'],
                        ],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        // Get submission where status is pending
        $dataProvider = new ActiveDataProvider([
            'query' => EditSubmission::find()->where(['status' => EditSubmission::STATUSES['pending']])->with('user'),
            'pagination' => [
                'pageSize' => 16,
            ],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = EditSubmission::find()->where(['id' => $id])->with('user')->one();
        $element = $model->getElement();
        return $this->render('view', [
            'model' => $model,
            'element' => $element,
        ]);
    }


    public function actionApprove($id)
    {
        $model = EditSubmission::find()->where(['id' => $id])->one();
        $element = $model->getElement();
        if ($model->table === "album" && $model->column === 'author_id') {
            // Set artist and band ids to null to make sure that if author is different type, there will be no double artist or band
            $element->artist_id = null;
            $element->band_id = null;

            $newAuthor = explode('-', $model->new_data);
            if ($newAuthor[0] === 'artist') {
                $element->artist_id = $newAuthor[1];
            } elseif ($newAuthor[0] === 'band') {
                $element->band_id = $newAuthor[1];
            }

        } elseif ($model->table === "album" && $model->column === "genre_id") {
            $this->editAlbumGenre($model);
        } elseif ($model->table === "track" && $model->column === "author_id") {
            $this->editFeaturedAuthor($model);
        } else {
            $element->{$model->column} = $model->new_data;
        }

        $element->updated_at = $model->created_at;
        $element->updated_by = $model->created_by;

        // Don't save element if it was genre edit
        if ($model->column !== 'genre_id') $element->save();

        $model->status = EditSubmission::STATUSES['approved'];
        $model->save();
        if ($model->table !== "track") {
            return $this->redirect([
                $model->table . '/view',
                'slug' => $element->slug,
            ]);
        } else {
            $track = Track::find()->where(['id' => $model->element_id])->one();

            return $this->redirect([
                'album/view',
                'slug' => Album::find()->where(['id' => $track->album_id])->one()->slug,
            ]);
        }

    }

    public function actionReject($id)
    {
        $model = EditSubmission::find()->where(['id' => $id])->one();
        $model->status = EditSubmission::STATUSES['rejected'];
        if ($model->save()) return $this->redirect(['index']);
    }

    function editAlbumGenre($model)
    {
        $diff = $this->diffInJson($model);

        foreach ($diff['add'] as $genre) {
            $record = new AlbumGenre();
            $record->album_id = $model->element_id;
            $record->genre_id = $genre;
            $record->save();
        }
        foreach ($diff['remove'] as $genre) {
            $record = AlbumGenre::find()->where(['album_id' => $model->element_id, 'genre_id' => $genre])->one();
            $record->delete();
        }
    }

    function editFeaturedAuthor($model)
    {
        $diff = $this->diffInJson($model);

        foreach ($diff['add'] as $authorId) {
            $record = new FeaturedAuthor();
            $record->track_id = $model->element_id;
            $author = explode('-', $authorId);
            if ($author[0] === 'artist') $record->artist_id = $author[1];
            elseif ($author[0] === 'band') $record->band_id = $author[1];
            $record->save();
        }
        foreach ($diff['remove'] as $authorId) {
            $author = explode('-', $authorId);
            $record = FeaturedAuthor::find()
                ->where(['track_id' => $model->element_id, $author[0] . "_id" => $author[1]])->one();
            $record->delete();
        }
    }

    #[ArrayShape(["add" => "array", "remove" => "array"])] function diffInJson($model): array
    {
        $newArray = json_decode($model->new_data) ?? [];
        $oldArray = json_decode($model->old_data) ?? [];

        // If new genre is not in old genre, add it to "add" array
        // If old genre is not in new genre, add it to "remove" array
        $diff = ["add" => [], "remove" => []];
        foreach ($newArray as $newGenre) {
            if (!in_array($newGenre, $oldArray)) {
                $diff["add"][] = $newGenre;
            }
        }
        foreach ($oldArray as $oldGenre) {
            if (!in_array($oldGenre, $newArray)) {
                $diff["remove"][] = $oldGenre;
            }
        }
        return $diff;
    }
}