<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%artist_article}}`.
 */
class m220722_151835_add_source_column_source_url_column_to_artist_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%artist_article}}', 'source', $this->string());
        $this->addColumn('{{%artist_article}}', 'source_url', $this->string(2048));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%artist_article}}', 'source');
        $this->dropColumn('{{%artist_article}}', 'source_url');
    }
}
