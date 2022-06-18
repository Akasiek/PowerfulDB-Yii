<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "artist_article".
 *
 * @property int $id
 * @property int|null $artist_id
 * @property string|null $text
 *
 * @property Artist $artist
 */
class ArtistArticle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'artist_article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['artist_id'], 'integer'],
            [['text'], 'string'],
            [['artist_id'], 'exist', 'skipOnError' => true, 'targetClass' => Artist::className(), 'targetAttribute' => ['artist_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'artist_id' => 'Artist ID',
            'text' => 'Text',
        ];
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
     * {@inheritdoc}
     * @return \common\models\query\ArtistArticleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ArtistArticleQuery(get_called_class());
    }
}
