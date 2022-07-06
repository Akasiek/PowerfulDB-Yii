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
 *
 * @property Album $album
 */
class Track extends \yii\db\ActiveRecord
{
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
            [['album_id', 'position'], 'default', 'value' => null],
            [['album_id', 'position'], 'integer'],
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
     * {@inheritdoc}
     * @return \common\models\query\TrackQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TrackQuery(get_called_class());
    }
}
