<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%artist_article}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%artist}}`
 */
class m220618_154743_create_artist_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%artist_article}}', [
            'id' => $this->primaryKey(),
            'artist_id' => $this->integer(),
            'text' => $this->text(),
        ]);

        // creates index for column `artist_id`
        $this->createIndex(
            '{{%idx-artist_article-artist_id}}',
            '{{%artist_article}}',
            'artist_id'
        );

        // add foreign key for table `{{%artist}}`
        $this->addForeignKey(
            '{{%fk-artist_article-artist_id}}',
            '{{%artist_article}}',
            'artist_id',
            '{{%artist}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%artist}}`
        $this->dropForeignKey(
            '{{%fk-artist_article-artist_id}}',
            '{{%artist_article}}'
        );

        // drops index for column `artist_id`
        $this->dropIndex(
            '{{%idx-artist_article-artist_id}}',
            '{{%artist_article}}'
        );

        $this->dropTable('{{%artist_article}}');
    }
}
