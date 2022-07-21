<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\FeaturedAuthor]].
 *
 * @see \common\models\FeaturedAuthor
 */
class FeaturedAuthorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\FeaturedAuthor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\FeaturedAuthor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
