<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "album_article".
 *
 * @property int $id
 * @property int|null $album_id
 * @property string|null $text
 *
 * @property Album $album
 */
class AlbumArticle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'album_article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['album_id'], 'integer'],
            [['text'], 'string'],
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
            'album_id' => 'Album ID',
            'text' => 'Text',
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
     * @return \common\models\query\AlbumArticleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\AlbumArticleQuery(get_called_class());
    }
}
