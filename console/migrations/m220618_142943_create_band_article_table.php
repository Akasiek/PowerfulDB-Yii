<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%band_article}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%band}}`
 */
class m220618_142943_create_band_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%band_article}}', [
            'id' => $this->primaryKey(),
            'band_id' => $this->integer(),
            'text' => $this->text(),
        ]);

        // creates index for column `band_id`
        $this->createIndex(
            '{{%idx-band_article-band_id}}',
            '{{%band_article}}',
            'band_id'
        );

        // add foreign key for table `{{%band}}`
        $this->addForeignKey(
            '{{%fk-band_article-band_id}}',
            '{{%band_article}}',
            'band_id',
            '{{%band}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%band}}`
        $this->dropForeignKey(
            '{{%fk-band_article-band_id}}',
            '{{%band_article}}'
        );

        // drops index for column `band_id`
        $this->dropIndex(
            '{{%idx-band_article-band_id}}',
            '{{%band_article}}'
        );

        $this->dropTable('{{%band_article}}');
    }
}
