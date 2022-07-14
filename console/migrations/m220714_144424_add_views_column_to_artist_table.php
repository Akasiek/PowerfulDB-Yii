<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%artist}}`.
 */
class m220714_144424_add_views_column_to_artist_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%artist}}', 'views', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%artist}}', 'views');
    }
}
