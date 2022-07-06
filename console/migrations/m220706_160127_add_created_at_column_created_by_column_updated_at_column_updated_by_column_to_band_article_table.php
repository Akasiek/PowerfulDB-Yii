<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%band_article}}`.
 */
class m220706_160127_add_created_at_column_created_by_column_updated_at_column_updated_by_column_to_band_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%band_article}}', 'created_at', $this->integer());
        $this->addColumn('{{%band_article}}', 'created_by', $this->integer());
        $this->addColumn('{{%band_article}}', 'updated_at', $this->integer());
        $this->addColumn('{{%band_article}}', 'updated_by', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%band_article}}', 'created_at');
        $this->dropColumn('{{%band_article}}', 'created_by');
        $this->dropColumn('{{%band_article}}', 'updated_at');
        $this->dropColumn('{{%band_article}}', 'updated_by');
    }
}
