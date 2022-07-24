<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%edit_submission}}`.
 */
class m220723_131918_create_edit_submission_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%edit_submission}}', [
            'id' => $this->primaryKey(),
            'table' => $this->string()->notNull(),
            'column' => $this->string()->notNull(),
            'element_id' => $this->integer()->notNull(),
            'old_data' => $this->string()->notNull(),
            'new_data' => $this->string()->notNull(),
            'status' => $this->integer()->notNull(),
            'created_by' => $this->integer(),
            'created_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%edit_submission}}');
    }
}
