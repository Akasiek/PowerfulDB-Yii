<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "genre".
 *
 * @property int $id
 * @property string $name
 */
class Genre extends \yii\db\ActiveRecord
{
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
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
        ];
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
