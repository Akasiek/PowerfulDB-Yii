<?php

namespace common\models;

use common\models\query\GenreQuery;
use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "artist".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $full_name
 * @property string|null $birth_date
 * @property string|null $death_date
 * @property string|null $bg_image_url
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Artist extends \yii\db\ActiveRecord
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
        return 'artist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['birth_date', 'death_date'], 'safe'],
            [['created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name', 'slug', 'full_name'], 'string', 'max' => 256],
            [['bg_image_url'], 'string', 'max' => 2048],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
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
            'full_name' => 'Full Name',
            'birth_date' => 'Birth Date',
            'death_date' => 'Death Date',
            'bg_image_url' => 'Background Image Url',
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
        return $this->hasMany(Album::className(), ['artist_id' => 'id']);
    }

    /**
     * Gets query for [[Album]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AlbumQuery
     */
    public function getLPs()
    {
        return $this->hasMany(Album::className(), ['artist_id' => 'id'])->andWhere(['type' => 'LP']);
    }

    /**
     * Gets query for [[Album]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AlbumQuery
     */
    public function getOtherAlbums()
    {
        return $this->hasMany(Album::className(), ['artist_id' => 'id'])->andWhere(['!=', 'type', 'LP']);
    }

    /**
     * Gets query for [[ArtistArticle]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AlbumArticleQuery
     */
    public function getArticle()
    {
        return $this->hasOne(ArtistArticle::className(), ['artist_id' => 'id']);
    }

    /**
     * Gets query for [[BandMember]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\BandMemberQuery
     */
    public function getBands()
    {
        return $this->hasMany(Band::className(), ['id' => 'band_id'])->viaTable('band_member', ['artist_id' => 'id']);
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
            ->where(['album.artist_id' => $this->id])
            ->groupBy('genre.name')
            ->orderBy('countgenre DESC');
    }

    /**
     * Gets query for [[BandMember]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\BandMemberQuery
     */
    public function getMemberships()
    {
        return $this
            ->hasMany(BandMember::className(), ['artist_id' => 'id'])
            ->with('band')
            ->orderBy('join_year DESC');
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ArtistQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ArtistQuery(get_called_class());
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
