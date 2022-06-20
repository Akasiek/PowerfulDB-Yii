<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%band_member}}`.
 */
class m220620_142911_add_join_year_column_quit_year_column_to_band_member_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%band_member}}', 'join_year', $this->integer(4));
        $this->addColumn('{{%band_member}}', 'quit_year', $this->integer(4));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%band_member}}', 'join_year');
        $this->dropColumn('{{%band_member}}', 'quit_year');
    }
}
