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
 * @property string|null $new_article
 * @property string|null $old_article
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
            [['table', 'column', 'element_id', 'status'], 'required'],
            [['element_id', 'status', 'created_by', 'created_at'], 'default', 'value' => null],
            [['element_id', 'status', 'created_by', 'created_at'], 'integer'],
            [['new_article', 'old_article'], 'string'],
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
            'element_id' => 'Element ID',
            'old_data' => 'Old Data',
            'new_data' => 'New Data',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'new_article' => 'New Article',
            'old_article' => 'Old Article',
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
            'band_member' => BandMember::find()
                ->where(['id' => $this->element_id])
                ->with(['artist', 'band'])
                ->one(),
            'album_article' => AlbumArticle::find()->where(['id' => $this->element_id])->with('album')->one(),
            'band_article' => BandArticle::find()->where(['id' => $this->element_id])->with('band')->one(),
            'artist_article' => ArtistArticle::find()->where(['id' => $this->element_id])->with('artist')->one(),
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
    public function setMainValues($table, $col, $elemId)
    {
        $this->table = $table;
        $this->column = $col;
        $this->element_id = $elemId;
        $this->status = EditSubmission::STATUSES['pending'];
        $this->created_at = time();
        $this->created_by = \Yii::$app->user->id;
    }

    public function setValues($table, $col, $elemId, $old, $new): void
    {
        $this->setMainValues($table, $col, $elemId);
        $this->old_data = $old;
        $this->new_data = $new;
    }


    public function setArticleValues($table, $col, $elemId, $old, $new): void
    {
        $this->setMainValues($table, $col, $elemId);
        $this->old_article = $old;
        $this->new_article = $new;
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
