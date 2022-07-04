<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "genre".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 *
 * @property AlbumGenre[] $albumGenres
 */
class Genre extends \yii\db\ActiveRecord
{
    public $countGenre;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'ensureUnique' => true,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genre';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
            'slug' => 'Slug',
        ];
    }

    /**
     * Gets query for [[AlbumGenres]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AlbumGenreQuery
     */
    public function getAlbumGenres()
    {
        return $this->hasMany(AlbumGenre::className(), ['genre_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\GenreQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\GenreQuery(get_called_class());
    }
}
