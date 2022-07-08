<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "artist_article".
 *
 * @property int $id
 * @property int|null $artist_id
 * @property string|null $text
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
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
            [['artist_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'default', 'value' => null],
            [['artist_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
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
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
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
