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
 * @property string|null $roles
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 *
 * @property Artist $artist
 * @property Band $band
 */
class BandMember extends \yii\db\ActiveRecord
{
    public $ct = '';
    public $created_date = '';
    public $updated_date = '';
    public $member_count = '';

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
            [['artist_id', 'band_id', 'join_year', 'quit_year', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'default', 'value' => null],
            [['artist_id', 'band_id', 'join_year', 'quit_year', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name', 'roles'], 'string', 'max' => 255],
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
            'roles' => 'Roles',
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
