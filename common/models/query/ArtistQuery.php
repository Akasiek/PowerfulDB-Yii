<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Artist]].
 *
 * @see \common\models\Artist
 */
class ArtistQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Artist[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Artist|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byKeyword($keyword)
    {
        return $this
            ->orWhere("\"name\" ILIKE :keyword", [':keyword' => '%' . $keyword . '%'])
            ->orWhere("\"full_name\" ILIKE :keyword", [':keyword' => '%' . $keyword . '%']);
    }
}
