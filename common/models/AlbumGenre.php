<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "album_genre".
 *
 * @property int $id
 * @property int $genre_id
 * @property int $album_id
 * @property int|null $band_id
 * @property int|null $artist_id
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 *
 * @property Album $album
 * @property Artist $artist
 * @property Band $band
 * @property Genre $genre
 */
class AlbumGenre extends \yii\db\ActiveRecord
{
    public $ct = '';
    public $created_date = '';
    public $updated_date = '';
    public $genre_count = '';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'album_genre';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['album_id', 'genre_id'], 'required'],
            [['album_id', 'genre_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'default', 'value' => null],
            [['album_id', 'genre_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
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
            'genre_id' => 'Genre ID',
            'album_id' => 'Album ID',
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
     * Gets query for [[Genre]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\GenreQuery
     */
    public function getGenre()
    {
        return $this->hasOne(Genre::className(), ['id' => 'genre_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\AlbumGenreQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\AlbumGenreQuery(get_called_class());
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
