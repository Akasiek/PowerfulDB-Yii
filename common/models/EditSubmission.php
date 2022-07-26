<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "edit_submission".
 *
 * @property int $id
 * @property string $table
 * @property string $column
 * @property string $old_data
 * @property string $new_data
 * @property int $status
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int $element_id
 */
class EditSubmission extends \yii\db\ActiveRecord
{
    const STATUSES = [
        'pending' => 0,
        'approved' => 1,
        'rejected' => 2,
    ];

    public $jsonString;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'edit_submission';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['table', 'column', 'status', 'element_id'], 'required'],
            [['old_data', 'new_data', 'status', 'created_by', 'created_at', 'element_id'], 'default', 'value' => null],
            [['status', 'created_by', 'created_at', 'element_id'], 'integer'],
            [['table', 'column', 'old_data', 'new_data'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table' => 'Table',
            'column' => 'Column',
            'old_data' => 'Old Data',
            'new_data' => 'New Data',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'element_id' => 'Element ID',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\EditSubmissionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\EditSubmissionQuery(get_called_class());
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }


    public function getElement()
    {
        return match ($this->table) {
            'album' => Album::findOne($this->element_id),
            'track' => Track::findOne($this->element_id),
            'artist' => Artist::findOne($this->element_id),
            'band' => Band::findOne($this->element_id),
            default => null,
        };
    }

    /**
     * @param $table
     * @param $col
     * @param $elemId
     * @param $old
     * @param $new
     * @return void
     */
    public function setValues($table, $col, $elemId, $old, $new): void
    {
        $this->table = $table;
        $this->column = $col;
        $this->element_id = $elemId;
        $this->old_data = $old;
        $this->new_data = $new;
        $this->status = EditSubmission::STATUSES['pending'];
        $this->created_at = time();
        $this->created_by = \Yii::$app->user->id;
    }

    public function saveSubmission()
    {
        if ($this->save()) {
            \Yii::$app->session->setFlash('success', 'Submission saved');
        } else {
            foreach ($this->getErrors() as $attributes) {
                foreach ($attributes as $error) {
                    \Yii::$app->session->setFlash('error', $error);
                }
            }
        }
    }
}
