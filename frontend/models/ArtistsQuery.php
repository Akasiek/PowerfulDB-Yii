<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Artists]].
 *
 * @see Artists
 */
class ArtistsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Artists[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Artists|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
