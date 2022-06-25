<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Album]].
 *
 * @see \common\models\Album
 */
class AlbumQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Album[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Album|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byKeyword($keyword)
    {
        return $this->leftJoin('artist', 'artist.id = album.artist_id')
            ->leftJoin('band', 'band.id = album.band_id')
            ->orWhere('"title" ILIKE :keyword', [':keyword' => '%' . $keyword . '%'])
            ->orWhere('"album"."slug" ILIKE :keyword', [':keyword' => '%' . $keyword . '%'])
            ->orWhere('"band"."name" ILIKE :keyword', [':keyword' => '%' . $keyword . '%'])
            ->orWhere('"band"."slug" ILIKE :keyword', [':keyword' => '%' . $keyword . '%'])
            ->orWhere('"artist"."name" ILIKE :keyword', [':keyword' => '%' . $keyword . '%'])
            ->orWhere('"artist"."slug" ILIKE :keyword', [':keyword' => '%' . $keyword . '%']);
    }
}
