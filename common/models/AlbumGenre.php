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
            [['genre_id', 'album_id'], 'required'],
            [['genre_id', 'album_id', 'band_id', 'artist_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'default', 'value' => null],
            [['genre_id', 'album_id', 'band_id', 'artist_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['album_id'], 'exist', 'skipOnError' => true, 'targetClass' => Album::className(), 'targetAttribute' => ['album_id' => 'id']],
            [['artist_id'], 'exist', 'skipOnError' => true, 'targetClass' => Artist::className(), 'targetAttribute' => ['artist_id' => 'id']],
            [['band_id'], 'exist', 'skipOnError' => true, 'targetClass' => Band::className(), 'targetAttribute' => ['band_id' => 'id']],
            [['genre_id'], 'exist', 'skipOnError' => true, 'targetClass' => Genre::className(), 'targetAttribute' => ['genre_id' => 'id']],
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
            'band_id' => 'Band ID',
            'artist_id' => 'Artist ID',
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
        // Add the artist_id or band_id from album_id
        if ($this->album_id) {
            $album = Album::findOne($this->album_id);
            if ($album) {
                if ($album->artist_id) {
                    $this->artist_id = $album->artist_id;
                } else if ($album->band_id) {
                    $this->band_id = $album->band_id;
                }
            }
        }

        if ($this->isNewRecord) {
            $this->created_at = time();
            $this->created_by = Yii::$app->user->id;
        }
        $this->updated_at = time();
        $this->updated_by = Yii::$app->user->id;

        return parent::save($runValidation, $attributeNames);
    }
}
