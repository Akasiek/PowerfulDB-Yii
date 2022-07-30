<?php

namespace frontend\controllers;

use common\models\Album;
use common\models\AlbumGenre;
use common\models\BandMember;
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

        } elseif ($model->column === "delete") {
            // Only when deleting
            $this->deleteElement($model, $element);
        } elseif ($model->column === 'text') {
            // Only for articles' text
            $element->text = $model->new_article;
        } elseif ($model->table === "album" && $model->column === "genre_id") {
            // Only for genres
            $this->editAlbumGenre($model);
        } elseif ($model->table === "track" && $model->column === "author_id") {
            // Only for tracks' featured authors
            $this->editFeaturedAuthor($model);
        } elseif ($model->table === "track" && $model->column === "position") {
            // Only for tracks' positions
            $this->editTrackPosition($model, $element);
        } else {
            $element->{$model->column} = $model->new_data;
        }

        $element->updated_at = $model->created_at;
        $element->updated_by = $model->created_by;

        // Don't save element if it was genre edit
        if ($model->column !== 'genre_id') $element->save();

        $model->status = EditSubmission::STATUSES['approved'];
        $model->save();
        if ($model->column === 'delete') {
            return $this->redirect(['index']);
        } elseif ($model->table === 'track') {
            $track = Track::find()->where(['id' => $model->element_id])->one();

            return $this->redirect([
                'album/view',
                'slug' => Album::find()->where(['id' => $track->album_id])->one()->slug,
            ]);
        } elseif ($model->table === 'band_member') {
            return $this->redirect(['band/view', 'slug' => $element->band->slug, '#' => 'members']);
        } elseif (in_array($model->table, ['album_article', 'band_article', 'artist_article'])) {
            $table = explode('_', $model->table);
            return $this->redirect([
                '/' . $table[0] . '/view',
                'slug' => $element->{$table[0]}->slug,
                '#' => 'article'
            ]);
        } else {
            return $this->redirect([
                $model->table . '/view',
                'slug' => $element->slug,
            ]);
        }

    }

    public function actionReject($id)
    {
        $model = EditSubmission::findOne($id);
        $model->status = EditSubmission::STATUSES['rejected'];
        if ($model->save()) return $this->redirect(['index']);
    }

    function deleteElement($model, $element)
    {
        if ($model->table === 'track') {
            // Move all tracks after deleted track to the previous position
            $tracks = Track::find()
                ->andWhere(['album_id' => $element->album_id])
                ->andWhere(['>', 'position', $element->position])->all();
            foreach ($tracks as $track) {
                $track->position--;
                $track->save();
            }

            // Delete featured authors associated with deleted track
            FeaturedAuthor::deleteAll(['track_id' => $element->id]);

            // Delete track
            Track::findOne($model->element_id)->delete();
        } elseif ($model->table === 'band_member') {
            // Delete band member
            BandMember::findOne($model->element_id)->delete();
        }
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

    function editTrackPosition($model, $element)
    {
        // Move all tracks above the old position, one position up
        $tracks = Track::find()
            ->andWhere(['album_id' => $element->album_id])
            ->andWhere(['>', 'position', $model->old_data])->all();
        foreach ($tracks as $track) {
            $track->position--;
            $track->save();
        }

        // Move all tracks above and on the same position as new position, one position down
        $tracks = Track::find()
            ->andWhere(['album_id' => $element->album_id])
            ->andWhere(['>=', 'position', $model->new_data])->all();
        foreach ($tracks as $track) {
            $track->position++;
            $track->save();
        }
        // Save new position
        $element->position = $model->new_data;
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