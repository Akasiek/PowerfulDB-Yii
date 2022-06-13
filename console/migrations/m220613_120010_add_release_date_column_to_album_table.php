<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%album}}`.
 */
class m220613_120010_add_release_date_column_to_album_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%album}}', 'release_date', $this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%album}}', 'release_date');
    }
}
