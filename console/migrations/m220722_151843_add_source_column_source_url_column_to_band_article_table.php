<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%band_article}}`.
 */
class m220722_151843_add_source_column_source_url_column_to_band_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%band_article}}', 'source', $this->string());
        $this->addColumn('{{%band_article}}', 'source_url', $this->string(2048));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%band_article}}', 'source');
        $this->dropColumn('{{%band_article}}', 'source_url');
    }
}
