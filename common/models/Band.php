<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "band".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $slug
 * @property int|null $founding_year
 * @property int|null $breakup_year
 * @property string|null $bg_image_url
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Band extends \yii\db\ActiveRecord
{
    public $ct = '';
    public $created_date = '';
    public $updated_date = '';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'ensureUnique' => true,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'band';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['founding_year', 'breakup_year', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['bg_image_url'], 'string', 'max' => 2048],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'founding_year' => 'Founding Year',
            'breakup_year' => 'Breakup Year',
            'bg_image_url' => 'Bg Image Url',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
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
     * Gets query for [[Album]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AlbumQuery
     */
    public function getAlbums()
    {
        return $this->hasMany(Album::className(), ['band_id' => 'id']);
    }


    /**
     * Gets query for [[Album]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AlbumQuery
     */
    public function getLPs()
    {
        return $this->hasMany(Album::className(), ['band_id' => 'id'])->andWhere(['type' => 'LP']);
    }

    /**
     * Gets query for [[Album]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AlbumQuery
     */
    public function getOtherAlbums()
    {
        return $this->hasMany(Album::className(), ['band_id' => 'id'])->andWhere(['!=', 'type', 'LP']);
    }

    /**
     * Gets query for [[Album]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AlbumQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getAlbumsAppearedOn(): \yii\db\ActiveQuery|query\AlbumQuery
    {
        return Album::find()
            ->select('album.*')
            ->innerJoin('track', 'track.album_id = album.id')
            ->innerJoin('featured_author', 'featured_author.track_id = track.id')
            ->where(['featured_author.band_id' => $this->id]);
    }

    /**
     * Gets query for [[BandMembers]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\BandMemberQuery
     */
    public function getMembers()
    {
        return $this
            ->hasMany(BandMember::className(), ['band_id' => 'id'])
            ->orderBy('join_year, artist_id')
            ->with('artist');
    }

    /**
     * Gets query for [[BandArticle]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AlbumArticleQuery
     */
    public function getArticle()
    {
        return $this->hasOne(BandArticle::className(), ['band_id' => 'id']);
    }

    /**
     * Gets query for [[Genre]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\GenreQuery
     */
    public function getGenres()
    {
        return Genre::find()
            ->select(['genre.name', 'COUNT(genre.name) AS countgenre'])
            ->innerJoin('album_genre', 'album_genre.genre_id = genre.id')
            ->innerJoin('album', 'album.id = album_genre.album_id')
            ->where(['album.band_id' => $this->id])
            ->groupBy('genre.name')
            ->orderBy('countgenre DESC');
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\BandQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\BandQuery(get_called_class());
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
