<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%album}}`.
 */
class m220719_191414_add_type_column_to_album_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%album}}', 'type', $this->string()->defaultValue('LP'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%album}}', 'type');
    }
}
