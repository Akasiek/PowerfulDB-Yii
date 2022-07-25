<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%album_genre}}`.
 */
class m220725_150856_drop_artist_id_column_band_id_column_from_album_genre_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%album_genre}}', 'artist_id');
        $this->dropColumn('{{%album_genre}}', 'band_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%album_genre}}', 'artist_id', $this->integer());
        $this->addColumn('{{%album_genre}}', 'band_id', $this->integer());
    }
}
