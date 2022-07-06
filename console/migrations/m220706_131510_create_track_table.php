<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%track}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%album}}`
 */
class m220706_131510_create_track_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%track}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'album_id' => $this->integer(),
            'duration' => $this->time(),
        ]);

        // creates index for column `album_id`
        $this->createIndex(
            '{{%idx-track-album_id}}',
            '{{%track}}',
            'album_id'
        );

        // add foreign key for table `{{%album}}`
        $this->addForeignKey(
            '{{%fk-track-album_id}}',
            '{{%track}}',
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
            '{{%fk-track-album_id}}',
            '{{%track}}'
        );

        // drops index for column `album_id`
        $this->dropIndex(
            '{{%idx-track-album_id}}',
            '{{%track}}'
        );

        $this->dropTable('{{%track}}');
    }
}
