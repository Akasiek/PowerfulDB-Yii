<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "band_article".
 *
 * @property int $id
 * @property int|null $band_id
 * @property string|null $text
 *
 * @property Band $band
 */
class BandArticle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'band_article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['band_id'], 'integer'],
            [['text'], 'string'],
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
            'band_id' => 'Band ID',
            'text' => 'Text',
        ];
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
     * @return \common\models\query\BandArticleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\BandArticleQuery(get_called_class());
    }
}
