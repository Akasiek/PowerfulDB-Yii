<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%artist_article}}`.
 */
class m220706_155945_add_created_at_column_created_by_column_updated_at_column_updated_by_column_to_artist_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%artist_article}}', 'created_at', $this->integer());
        $this->addColumn('{{%artist_article}}', 'created_by', $this->integer());
        $this->addColumn('{{%artist_article}}', 'updated_at', $this->integer());
        $this->addColumn('{{%artist_article}}', 'updated_by', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%artist_article}}', 'created_at');
        $this->dropColumn('{{%artist_article}}', 'created_by');
        $this->dropColumn('{{%artist_article}}', 'updated_at');
        $this->dropColumn('{{%artist_article}}', 'updated_by');
    }
}
