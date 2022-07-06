<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%genre}}`.
 */
class m220706_154716_add_created_at_column_created_by_column_updated_at_column_updated_by_column_to_genre_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%genre}}', 'created_at', $this->integer());
        $this->addColumn('{{%genre}}', 'created_by', $this->integer());
        $this->addColumn('{{%genre}}', 'updated_at', $this->integer());
        $this->addColumn('{{%genre}}', 'updated_by', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%genre}}', 'created_at');
        $this->dropColumn('{{%genre}}', 'created_by');
        $this->dropColumn('{{%genre}}', 'updated_at');
        $this->dropColumn('{{%genre}}', 'updated_by');
    }
}
