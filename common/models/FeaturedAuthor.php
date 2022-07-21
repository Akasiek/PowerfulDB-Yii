<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "featured_author".
 *
 * @property int $id
 * @property int|null $track_id
 * @property int|null $artist_id
 * @property int|null $band_id
 *
 * @property Artist $artist
 * @property Band $band
 * @property Track $track
 */
class FeaturedAuthor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'featured_author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['track_id', 'artist_id', 'band_id'], 'default', 'value' => null],
            [['track_id', 'artist_id', 'band_id'], 'integer'],
            [['artist_id'], 'exist', 'skipOnError' => true, 'targetClass' => Artist::className(), 'targetAttribute' => ['artist_id' => 'id']],
            [['band_id'], 'exist', 'skipOnError' => true, 'targetClass' => Band::className(), 'targetAttribute' => ['band_id' => 'id']],
            [['track_id'], 'exist', 'skipOnError' => true, 'targetClass' => Track::className(), 'targetAttribute' => ['track_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'track_id' => 'Track ID',
            'artist_id' => 'Artist ID',
            'band_id' => 'Band ID',
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
     * Gets query for [[Band]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\BandQuery
     */
    public function getBand()
    {
        return $this->hasOne(Band::className(), ['id' => 'band_id']);
    }

    /**
     * Gets query for [[Track]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TrackQuery
     */
    public function getTrack()
    {
        return $this->hasOne(Track::className(), ['id' => 'track_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\FeaturedAuthorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\FeaturedAuthorQuery(get_called_class());
    }
}
