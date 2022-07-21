<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%featured_author}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%track}}`
 * - `{{%artist}}`
 * - `{{%band}}`
 */
class m220721_172013_create_featured_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%featured_author}}', [
            'id' => $this->primaryKey(),
            'track_id' => $this->integer(),
            'artist_id' => $this->integer(),
            'band_id' => $this->integer(),
        ]);

        // creates index for column `track_id`
        $this->createIndex(
            '{{%idx-featured_author-track_id}}',
            '{{%featured_author}}',
            'track_id'
        );

        // add foreign key for table `{{%track}}`
        $this->addForeignKey(
            '{{%fk-featured_author-track_id}}',
            '{{%featured_author}}',
            'track_id',
            '{{%track}}',
            'id',
            'CASCADE'
        );

        // creates index for column `artist_id`
        $this->createIndex(
            '{{%idx-featured_author-artist_id}}',
            '{{%featured_author}}',
            'artist_id'
        );

        // add foreign key for table `{{%artist}}`
        $this->addForeignKey(
            '{{%fk-featured_author-artist_id}}',
            '{{%featured_author}}',
            'artist_id',
            '{{%artist}}',
            'id',
            'CASCADE'
        );

        // creates index for column `band_id`
        $this->createIndex(
            '{{%idx-featured_author-band_id}}',
            '{{%featured_author}}',
            'band_id'
        );

        // add foreign key for table `{{%band}}`
        $this->addForeignKey(
            '{{%fk-featured_author-band_id}}',
            '{{%featured_author}}',
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
        // drops foreign key for table `{{%track}}`
        $this->dropForeignKey(
            '{{%fk-featured_author-track_id}}',
            '{{%featured_author}}'
        );

        // drops index for column `track_id`
        $this->dropIndex(
            '{{%idx-featured_author-track_id}}',
            '{{%featured_author}}'
        );

        // drops foreign key for table `{{%artist}}`
        $this->dropForeignKey(
            '{{%fk-featured_author-artist_id}}',
            '{{%featured_author}}'
        );

        // drops index for column `artist_id`
        $this->dropIndex(
            '{{%idx-featured_author-artist_id}}',
            '{{%featured_author}}'
        );

        // drops foreign key for table `{{%band}}`
        $this->dropForeignKey(
            '{{%fk-featured_author-band_id}}',
            '{{%featured_author}}'
        );

        // drops index for column `band_id`
        $this->dropIndex(
            '{{%idx-featured_author-band_id}}',
            '{{%featured_author}}'
        );

        $this->dropTable('{{%featured_author}}');
    }
}
