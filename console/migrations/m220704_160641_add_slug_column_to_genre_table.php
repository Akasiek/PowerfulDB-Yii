<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%genre}}`.
 */
class m220704_160641_add_slug_column_to_genre_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%genre}}', 'slug', $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%genre}}', 'slug');
    }
}
