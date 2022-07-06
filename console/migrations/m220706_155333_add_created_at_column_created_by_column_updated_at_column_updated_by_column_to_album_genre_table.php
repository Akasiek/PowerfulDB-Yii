<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%album_genre}}`.
 */
class m220706_155333_add_created_at_column_created_by_column_updated_at_column_updated_by_column_to_album_genre_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%album_genre}}', 'created_at', $this->integer());
        $this->addColumn('{{%album_genre}}', 'created_by', $this->integer());
        $this->addColumn('{{%album_genre}}', 'updated_at', $this->integer());
        $this->addColumn('{{%album_genre}}', 'updated_by', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%album_genre}}', 'created_at');
        $this->dropColumn('{{%album_genre}}', 'created_by');
        $this->dropColumn('{{%album_genre}}', 'updated_at');
        $this->dropColumn('{{%album_genre}}', 'updated_by');
    }
}
