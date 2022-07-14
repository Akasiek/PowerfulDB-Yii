<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%album}}`.
 */
class m220714_144237_add_views_column_to_album_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%album}}', 'views', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%album}}', 'views');
    }
}
