<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%band_member}}`.
 */
class m220620_152538_add_roles_column_to_band_member_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%band_member}}', 'roles', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%band_member}}', 'roles');
    }
}
