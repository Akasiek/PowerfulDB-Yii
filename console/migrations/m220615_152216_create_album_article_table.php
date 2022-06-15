<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%album_article}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%album}}`
 */
class m220615_152216_create_album_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%album_article}}', [
            'id' => $this->primaryKey(),
            'album_id' => $this->integer(),
            'text' => $this->text(),
        ]);

        // creates index for column `album_id`
        $this->createIndex(
            '{{%idx-album_article-album_id}}',
            '{{%album_article}}',
            'album_id'
        );

        // add foreign key for table `{{%album}}`
        $this->addForeignKey(
            '{{%fk-album_article-album_id}}',
            '{{%album_article}}',
            'album_id',
            '{{%album}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%album}}`
        $this->dropForeignKey(
            '{{%fk-album_article-album_id}}',
            '{{%album_article}}'
        );

        // drops index for column `album_id`
        $this->dropIndex(
            '{{%idx-album_article-album_id}}',
            '{{%album_article}}'
        );

        $this->dropTable('{{%album_article}}');
    }
}
