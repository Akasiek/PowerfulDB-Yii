<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%band}}`.
 */
class m220714_144433_add_views_column_to_band_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%band}}', 'views', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%band}}', 'views');
    }
}
