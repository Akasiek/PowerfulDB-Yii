<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "album".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int|null $band_id
 * @property int|null $artist_id
 * @property string|null $artwork_url
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property string|null $release_date
 * @property int|null $views
 * @property string|null $type
 *
 * @property AlbumArticle[] $albumArticles
 * @property AlbumGenre[] $albumGenres
 * @property Artist $artist
 * @property Band $band
 * @property Track[] $tracks
 */
class Album extends \yii\db\ActiveRecord
{
    public $ct = '';
    public $created_date = '';
    public $updated_date = '';

    const TYPES = [
        'LP',
        'Single',
        'Compilation',
        'EP',
        'Live Album',
        'Remix',
        'Soundtrack',
        'Other',
    ];

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'ensureUnique' => true,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'album';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug'], 'required'],
            [['band_id', 'artist_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'views'], 'default', 'value' => null],
            [['band_id', 'artist_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'views'], 'integer'],
            [['release_date'], 'safe'],
            [['title', 'slug', 'type'], 'string', 'max' => 255],
            [['artwork_url'], 'string', 'max' => 2048],
            [['artist_id'], 'exist', 'skipOnError' => true, 'targetClass' => Artist::className(), 'targetAttribute' => ['artist_id' => 'id']],
            [['band_id'], 'exist', 'skipOnError' => true, 'targetClass' => Band::className(), 'targetAttribute' => ['band_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'band_id' => 'Band ID',
            'artist_id' => 'Artist ID',
            'artwork_url' => 'Artwork Url',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'release_date' => 'Release Date',
            'views' => 'Views',
            'type' => 'Type',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[Artist]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ArtistQuery
     */
    public function getArtist()
    {
        return $this->hasOne(Artist::className(), ['id' => 'artist_id']);
    }

    /**
     * Gets query for [[Band]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\BandQuery
     */
    public function getBand()
    {
        return $this->hasOne(Band::className(), ['id' => 'band_id']);
    }

    /**
     * Gets query for [[AlbumArticle]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AlbumArticleQuery
     */
    public function getArticle()
    {
        return $this->hasOne(AlbumArticle::className(), ['album_id' => 'id']);
    }

    /**
     * Gets query for [[Genre]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\GenreQuery
     */
    public function getGenres()
    {
        return $this->hasMany(Genre::className(), ['id' => 'genre_id'])->viaTable('album_genre', ['album_id' => 'id']);
    }

    /**
     * Gets query for [[Track]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TrackQuery
     */
    public function getTracks()
    {
        return $this->hasMany(Track::className(), ['album_id' => 'id'])->orderBy('position');
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\AlbumQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\AlbumQuery(get_called_class());
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->isNewRecord) {
            $this->created_at = time();
            $this->created_by = Yii::$app->user->id;
            $this->updated_at = time();
            $this->updated_by = Yii::$app->user->id;
        }
        return parent::save($runValidation, $attributeNames);
    }
}
