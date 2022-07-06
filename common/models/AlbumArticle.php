<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "album_article".
 *
 * @property int $id
 * @property int|null $album_id
 * @property string|null $text
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
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
            [['album_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'default', 'value' => null],
            [['album_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
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
     * {@inheritdoc}
     * @return \common\models\query\AlbumArticleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\AlbumArticleQuery(get_called_class());
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
