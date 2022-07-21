<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "track".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int|null $album_id
 * @property string|null $duration
 * @property int $position
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 *
 * @property Album $album
 * @property FeaturedAuthor[] $featuredAuthors 
 */
class Track extends \yii\db\ActiveRecord
{
    public $ct = '';
    public $created_date = '';
    public $updated_date = '';
    public $track_count = '';

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
        return 'track';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'position'], 'required'],
            [['album_id', 'position', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'default', 'value' => null],
            [['album_id', 'position', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['duration'], 'safe'],
            [['title', 'slug'], 'string', 'max' => 255],
            [['album_id'], 'exist', 'skipOnError' => true, 'targetClass' => Album::className(), 'targetAttribute' => ['album_id' => 'id']],
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
            'album_id' => 'Album ID',
            'duration' => 'Duration',
            'position' => 'Position',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Album]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AlbumQuery
     */
    public function getAlbum()
    {
        return $this->hasOne(Album::className(), ['id' => 'album_id']);
    }

    /**
     * Gets query for [[FeaturedAuthors]]. 
     * 
     * @return \yii\db\ActiveQuery|\common\models\query\FeaturedAuthorQuery 
     */
    public function getFeaturedAuthors()
    {
        return $this->hasMany(FeaturedAuthor::className(), ['track_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\TrackQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TrackQuery(get_called_class());
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->isNewRecord) {
            $this->created_at = time();
            $this->created_by = Yii::$app->user->id;
        }
        $this->updated_at = time();
        $this->updated_by = Yii::$app->user->id;

        return parent::save($runValidation, $attributeNames);
    }
}
