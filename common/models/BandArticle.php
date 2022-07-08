<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "band_article".
 *
 * @property int $id
 * @property int|null $band_id
 * @property string|null $text
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
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
            [['band_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'default', 'value' => null],
            [['band_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
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
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
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
