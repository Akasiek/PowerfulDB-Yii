<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Band]].
 *
 * @see \common\models\Band
 */
class BandQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Band[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Band|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byKeyword($keyword)
    {
        return $this->orWhere("\"name\" ILIKE :keyword", [':keyword' => '%' . $keyword . '%']);
    }
}
