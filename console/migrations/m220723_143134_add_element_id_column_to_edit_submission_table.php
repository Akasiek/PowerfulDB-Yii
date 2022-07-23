<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%edit_submission}}`.
 */
class m220723_143134_add_element_id_column_to_edit_submission_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%edit_submission}}', 'element_id', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%edit_submission}}', 'element_id');
    }
}
