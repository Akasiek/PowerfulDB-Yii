<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%album_genre}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%genre}}`
 * - `{{%album}}`
 * - `{{%band}}`
 * - `{{%artist}}`
 */
class m220703_192801_create_album_genre_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%album_genre}}', [
            'id' => $this->primaryKey(),
            'genre_id' => $this->integer()->notNull(),
            'album_id' => $this->integer()->notNull(),
            'band_id' => $this->integer(),
            'artist_id' => $this->integer(),
        ]);

        // creates index for column `genre_id`
        $this->createIndex(
            '{{%idx-album_genre-genre_id}}',
            '{{%album_genre}}',
            'genre_id'
        );

        // add foreign key for table `{{%genre}}`
        $this->addForeignKey(
            '{{%fk-album_genre-genre_id}}',
            '{{%album_genre}}',
            'genre_id',
            '{{%genre}}',
            'id',
            'CASCADE'
        );

        // creates index for column `album_id`
        $this->createIndex(
            '{{%idx-album_genre-album_id}}',
            '{{%album_genre}}',
            'album_id'
        );

        // add foreign key for table `{{%album}}`
        $this->addForeignKey(
            '{{%fk-album_genre-album_id}}',
            '{{%album_genre}}',
            'album_id',
            '{{%album}}',
            'id',
            'CASCADE'
        );

        // creates index for column `band_id`
        $this->createIndex(
            '{{%idx-album_genre-band_id}}',
            '{{%album_genre}}',
            'band_id'
        );

        // add foreign key for table `{{%band}}`
        $this->addForeignKey(
            '{{%fk-album_genre-band_id}}',
            '{{%album_genre}}',
            'band_id',
            '{{%band}}',
            'id',
            'CASCADE'
        );

        // creates index for column `artist_id`
        $this->createIndex(
            '{{%idx-album_genre-artist_id}}',
            '{{%album_genre}}',
            'artist_id'
        );

        // add foreign key for table `{{%artist}}`
        $this->addForeignKey(
            '{{%fk-album_genre-artist_id}}',
            '{{%album_genre}}',
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
        // drops foreign key for table `{{%genre}}`
        $this->dropForeignKey(
            '{{%fk-album_genre-genre_id}}',
            '{{%album_genre}}'
        );

        // drops index for column `genre_id`
        $this->dropIndex(
            '{{%idx-album_genre-genre_id}}',
            '{{%album_genre}}'
        );

        // drops foreign key for table `{{%album}}`
        $this->dropForeignKey(
            '{{%fk-album_genre-album_id}}',
            '{{%album_genre}}'
        );

        // drops index for column `album_id`
        $this->dropIndex(
            '{{%idx-album_genre-album_id}}',
            '{{%album_genre}}'
        );

        // drops foreign key for table `{{%band}}`
        $this->dropForeignKey(
            '{{%fk-album_genre-band_id}}',
            '{{%album_genre}}'
        );

        // drops index for column `band_id`
        $this->dropIndex(
            '{{%idx-album_genre-band_id}}',
            '{{%album_genre}}'
        );

        // drops foreign key for table `{{%artist}}`
        $this->dropForeignKey(
            '{{%fk-album_genre-artist_id}}',
            '{{%album_genre}}'
        );

        // drops index for column `artist_id`
        $this->dropIndex(
            '{{%idx-album_genre-artist_id}}',
            '{{%album_genre}}'
        );

        $this->dropTable('{{%album_genre}}');
    }
}
