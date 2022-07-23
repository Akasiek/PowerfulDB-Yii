<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\EditSubmission]].
 *
 * @see \common\models\EditSubmission
 */
class EditSubmissionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\EditSubmission[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\EditSubmission|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
