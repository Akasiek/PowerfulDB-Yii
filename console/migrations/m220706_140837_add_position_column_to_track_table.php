<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%track}}`.
 */
class m220706_140837_add_position_column_to_track_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%track}}', 'position', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%track}}', 'position');
    }
}
