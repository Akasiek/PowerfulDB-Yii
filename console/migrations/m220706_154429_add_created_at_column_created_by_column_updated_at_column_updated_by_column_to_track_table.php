<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%track}}`.
 */
class m220706_154429_add_created_at_column_created_by_column_updated_at_column_updated_by_column_to_track_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%track}}', 'created_at', $this->integer());
        $this->addColumn('{{%track}}', 'created_by', $this->integer());
        $this->addColumn('{{%track}}', 'updated_at', $this->integer());
        $this->addColumn('{{%track}}', 'updated_by', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%track}}', 'created_at');
        $this->dropColumn('{{%track}}', 'created_by');
        $this->dropColumn('{{%track}}', 'updated_at');
        $this->dropColumn('{{%track}}', 'updated_by');
    }
}
