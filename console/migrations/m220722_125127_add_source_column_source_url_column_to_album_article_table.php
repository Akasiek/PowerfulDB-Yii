<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%album_article}}`.
 */
class m220722_125127_add_source_column_source_url_column_to_album_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%album_article}}', 'source', $this->string());
        $this->addColumn('{{%album_article}}', 'source_url', $this->string(2048));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%album_article}}', 'source');
        $this->dropColumn('{{%album_article}}', 'source_url');
    }
}
