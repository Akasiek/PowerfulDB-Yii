<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "band_member".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $artist_id
 * @property int|null $band_id
 * @property int|null $join_year
 * @property int|null $quit_year
 *
 * @property Artist $artist
 * @property Band $band
 */
class BandMember extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'band_member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['artist_id', 'band_id', 'join_year', 'quit_year'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['artist_id'], 'exist', 'skipOnError' => true, 'targetClass' => Artist::className(), 'targetAttribute' => ['artist_id' => 'id']],
            [['band_id'], 'exist', 'skipOnError' => true, 'targetClass' => Band::className(), 'targetAttribute' => ['band_id' => 'id']],
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
            'artist_id' => 'Artist ID',
            'band_id' => 'Band ID',
            'join_year' => 'Join Year',
            'quit_year' => 'Quit Year',
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
     * {@inheritdoc}
     * @return \common\models\query\BandMemberQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\BandMemberQuery(get_called_class());
    }
}
