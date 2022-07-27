<?php

namespace frontend\controllers;

use common\models\Album;
use common\models\AlbumArticle;
use common\models\AlbumGenre;
use common\models\DeleteSubmission;
use common\models\EditSubmission;
use common\models\FeaturedAuthor;
use common\models\Track;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\helpers\Url;
use yii\web\Controller;

include \Yii::getAlias('@frontend/web/checkModelDiff.php');
include \Yii::getAlias('@frontend/web/arrayEqual.php');

class AlbumController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => [
                    'create',
                    'edit',
                    'article-create',
                    'genre-add',
                    'track-add'
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        $sort = new Sort([
            'attributes' => [
                'popularity' => [
                    'desc' => ['album.views' => SORT_DESC],
                ],
                'title' => [
                    'asc' => ['album.title' => SORT_ASC],
                    'desc' => ['album.title' => SORT_DESC],
                ],
                'release_date' => [
                    'asc' => ['album.release_date' => SORT_ASC],
                    'desc' => ['album.release_date' => SORT_DESC],
                ],
            ],
            'defaultOrder' => ['release_date' => SORT_DESC],
        ]);

        $query = Album::find()
            ->leftJoin('artist', 'artist.id = album.artist_id')
            ->leftJoin('band', 'band.id = album.band_id')
            ->leftJoin('album_genre', 'album_genre.album_id = album.id')
            ->leftJoin('genre', 'genre.id = album_genre.genre_id')
            ->orderBy($sort->orders)
            ->distinct();


        // Check if any filters are set
        $filters = \Yii::$app->request->get();
        if (isset($filters['release_from_year']) && $filters['release_from_year'] != '') {
            $query->andWhere('EXTRACT(YEAR FROM release_date) >= :from_year', [':from_year' => $filters['release_from_year']]);
        }
        if (isset($filters['release_to_year']) && $filters['release_to_year'] != '') {
            $query->andWhere('EXTRACT(YEAR FROM release_date) <= :to_year', [':to_year' => $filters['release_to_year']]);
        }
        if (isset($filters['genre']) && $filters['genre'] != '') {
            $query->andWhere('genre.name ILIKE :genre', [':genre' => '%' . trim($filters['genre']) . '%']);
        }
        if (isset($filters['type']) && $filters['type'] != '') {
            $query->andWhere(array('IN', 'album.type', $filters['type']));
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 24,
            ],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'sort' => $sort,
        ]);
    }

    public function actionView($slug)
    {
        $model = Album::find()->where(['slug' => $slug])->with('artist', 'band')->one();

        // If user refreshed site, don't count view
        if (Url::current() !== Url::previous()) {
            $model->views += 1;
            $model->save();
            Url::remember();
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Album();

        if ($model->load(\Yii::$app->request->post())) {

            // Check if author_id is set. If not, send an error message.
            $author_id = \Yii::$app->request->post('author_id');
            if ($author_id == '') {
                \Yii::$app->session->setFlash('author_id', 'Please select an artist or a band.');
                return $this->render('create', [
                    'model' => $model,
                ]);
            }

            // Check if author is an artist or band and set the appropriate id
            $author = explode('-', $author_id);
            if ($author[0] == 'artist') $model->artist_id = $author[1];
            else $model->band_id = $author[1];

            // Set type of album
            $model->type = \Yii::$app->request->post('type');

            // Check if the album already exists
            $duplicate = Album::find()
                ->where(
                    'artist_id = :artist_id OR band_id = :band_id',
                    [':artist_id' => $model->artist_id, ':band_id' => $model->band_id]
                )
                ->andWhere('title = :title', [':title' => $model->title])
                ->one();
            if ($duplicate) {
                \Yii::$app->session->setFlash('duplicate', 'This album already exists.');
                return $this->render('create', [
                    'model' => $model,
                ]);
            }

            if ($model->save()) {
                return $this->redirect(['view', 'slug' => $model->slug]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionEdit($slug)
    {
        $model = Album::find()->where(['slug' => $slug])->one();

        if ($model->load(\Yii::$app->request->post())) {
            // Add type to model from post
            $model->type = \Yii::$app->request->post('type');

            // Check for differences in models
            $diff = checkModelDiff($model);
            foreach ($diff as $column => $value) {
                $submission = new EditSubmission();
                $submission->setValues('album', $column, $model->id, $value['old'], $value['new']);
                $submission->saveSubmission();
            }

            // Get model artist or band and add prefix to it
            if ($model->artist_id) $modelAuthor = 'artist-' . $model->artist_id;
            else $modelAuthor = 'band-' . $model->band_id;

            if (\Yii::$app->request->post('author_id') !== $modelAuthor) {
                $author = \Yii::$app->request->post('author_id');
                $submission = new EditSubmission();
                $submission->setValues('album', 'author_id', $model->id, $modelAuthor, $author);
                $submission->saveSubmission();
            }

            return $this->redirect(['view', 'slug' => $model->slug]);
        }
        return $this->render('edit', [
            'model' => $model,
        ]);

    }

    public function actionArticleCreate($slug)
    {
        $model = new AlbumArticle();

        $album = Album::findOne(['slug' => $slug]);

        if ($model->load(\Yii::$app->request->post())) {
            $model->album_id = $album->id;
            if ($model->save()) {
                return $this->redirect(['view', 'slug' => $slug]);
            }
        } else {
            return $this->render('article/create', [
                'model' => $model,
            ]);
        }
    }

    public function actionGenreAdd($slug)
    {
        $album = Album::findOne(['slug' => $slug]);

        $genres = \Yii::$app->request->post('genres');
        if ($genres) {
            foreach ($genres as $genre) {
                $albumGenre = new AlbumGenre();
                $albumGenre->genre_id = $genre;
                $albumGenre->album_id = $album->id;
                $albumGenre->save();
            }
            return $this->redirect(['/album/view', 'slug' => $slug]);
        } else {
            return $this->render('genre/add', [
                'album' => $album,
            ]);
        }
    }

    public function actionGenreEdit($slug)
    {
        $album = Album::findOne(['slug' => $slug]);
        $albumGenres = AlbumGenre::find()->where(['album_id' => $album->id])->all();

        if (\Yii::$app->request->post()) {
            // Create array of new and old genres
            $newGenres = \Yii::$app->request->post('genres');
            $oldGenres = [];
            foreach ($albumGenres as $genre) {
                $oldGenres[] = $genre->genre_id;
            }

            // Check if arrays are identical, if yes, don't create new submission
            if (arrayEqual($oldGenres, $newGenres)) {
                \Yii::$app->session->setFlash('error', 'No changes made.');
                return $this->redirect(['/album/view', 'slug' => $slug]);
            }

            // Create json decode of genre arrays
            $newData = json_encode($newGenres);
            $oldData = json_encode($oldGenres);

            // Create submission
            $submission = new EditSubmission();
            $submission->setValues('album', 'genre_id', $album->id, $oldData, $newData);
            $submission->saveSubmission();

            return $this->redirect(['/album/view', 'slug' => $slug]);
        } else {
            return $this->render('genre/edit', [
                'album' => $album,
                'albumGenres' => $albumGenres,
            ]);
        }

    }

    public function actionTrackCreate($slug)
    {
        $album = Album::findOne(['slug' => $slug]);

        $tracks = \Yii::$app->request->post('tracks');
        if ($tracks) {
            $tracksDuration = \Yii::$app->request->post('tracks_duration');
            $featuredAuthorId = \Yii::$app->request->post('featured_author_id');

            foreach ($tracks as $position => $track) {
                $trackModel = new Track();
                $trackModel->album_id = $album->id;
                $trackModel->title = $track;
                $trackModel->duration = $tracksDuration[$position];
                $trackModel->position = $position;
                $trackModel->save();
            }

            if (isset($featuredAuthor)) {
                foreach ($featuredAuthorId as $authorTrackPos => $featuredAuthor) {
                    $authorModel = new FeaturedAuthor();

                    // Find track for this author
                    $authorTrack = Track::find()
                        ->where(['album_id' => $album->id, 'position' => $authorTrackPos])->one();
                    $authorModel->track_id = $authorTrack->id;

                    // Check if author is an artist or band and set the appropriate id
                    $author = explode('-', $featuredAuthor);
                    if ($author[0] == 'artist') {
                        $authorModel->artist_id = $author[1];
                    } else {
                        $authorModel->band_id = $author[1];
                    }
                    $authorModel->save();
                }
            }
            return $this->redirect(['/album/view', 'slug' => $slug]);
        } else {
            return $this->render('track/create', [
                'album' => $album,
            ]);
        }
    }

    public function actionTrackAdd($slug)
    {
        $model = new Track();
        $album = Album::findOne(['slug' => $slug]);

        if ($model->load(\Yii::$app->request->post())) {
            // Check if track already exists
            $track = Track::find()->where([
                'album_id' => $album->id,
                'title' => $model->title,
                'position' => $model->position,
                'duration' => $model->duration,
            ])->one();
            if ($track) {
                \Yii::$app->session->setFlash('error', 'Track already exists.');
                return $this->redirect(['/album/view', 'slug' => $slug]);
            }

            // Get all tracks that have position greater or equal than the new track
            $tracks = Track::find()
                ->andWhere(['album_id' => $album->id])
                ->andWhere(['>=', 'position', $model->position])->all();
            // Increase position of all tracks by 1
            foreach ($tracks as $track) {
                $track->position = $track->position + 1;
                $track->save();
            }

            // Save new track
            $model->album_id = $album->id;
            if ($model->save()) {
                // Set featured authors for new track
                $authorsPost = \Yii::$app->request->post('featured_author') ?? [];
                foreach ($authorsPost as $authorPost) {
                    $featuredAuthor = new FeaturedAuthor();
                    $featuredAuthor->track_id = $model->id;
                    $author = explode('-', $authorPost);
                    if ($author[0] == 'artist') $featuredAuthor->artist_id = $author[1];
                    else $featuredAuthor->band_id = $author[1];
                    $featuredAuthor->save();
                }

                return $this->redirect(['/album/view', 'slug' => $slug]);
            }
        } else {
            return $this->render('track/add', [
                'model' => $model,
                'album' => $album,
            ]);
        }
    }

    public function actionTrackEdit($albumSlug, $trackSlug)
    {
        $album = Album::findOne(['slug' => $albumSlug]);
        $model = Track::findOne(['slug' => $trackSlug]);


        if ($model->load(\Yii::$app->request->post())) {
            // Check normal model difference (title, duration, position)
            $diff = checkModelDiff($model);
            foreach ($diff as $col => $data) {
                $submission = new EditSubmission();
                $submission->setValues('track', $col, $model->id, (string)$data['old'], (string)$data['new']);
                $submission->saveSubmission();
            }

            // Check featured author difference
            $oldFeaturedAuthors = [];
            foreach ($model->getFeaturedAuthors()->all() as $author) {
                if ($author->artist) $oldFeaturedAuthors[] = 'artist-' . $author->artist_id;
                else $oldFeaturedAuthors[] = 'band-' . $author->band_id;
            }
            $newFeaturedAuthors = \Yii::$app->request->post('featured_author') ?? [];
            if (!arrayEqual($newFeaturedAuthors, $oldFeaturedAuthors)) {
                $submission = new EditSubmission();
                $submission->setValues(
                    'track',
                    'author_id',
                    $model->id,
                    json_encode($oldFeaturedAuthors),
                    json_encode($newFeaturedAuthors)
                );
                $submission->saveSubmission();
            }

            return $this->redirect(['/album/view', 'slug' => $albumSlug]);
        } else {
            return $this->render('track/edit', [
                'album' => $album,
                'model' => $model,
            ]);
        }
    }

    public function actionTrackDelete($id)
    {
        // Create submission for track deletion
        $track = Track::findOne($id);
        $submission = new EditSubmission();
        $submission->setValues('track', 'delete', $track->id, (string)$track->id, '0');
        $submission->saveSubmission();
        return $this->redirect(['/album/view', 'slug' => Album::findOne($track->album_id)->slug]);
    }
}
