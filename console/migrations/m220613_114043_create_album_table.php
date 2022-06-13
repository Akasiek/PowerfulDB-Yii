<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%album}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%band}}`
 * - `{{%artist}}`
 */
class m220613_114043_create_album_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%album}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'band_id' => $this->integer(),
            'artist_id' => $this->integer(),
            'artwork_url' => $this->string(2048),
            'created_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'updated_by' => $this->integer(11),
        ]);

        // creates index for column `band_id`
        $this->createIndex(
            '{{%idx-album-band_id}}',
            '{{%album}}',
            'band_id'
        );

        // add foreign key for table `{{%band}}`
        $this->addForeignKey(
            '{{%fk-album-band_id}}',
            '{{%album}}',
            'band_id',
            '{{%band}}',
            'id',
            'CASCADE'
        );

        // creates index for column `artist_id`
        $this->createIndex(
            '{{%idx-album-artist_id}}',
            '{{%album}}',
            'artist_id'
        );

        // add foreign key for table `{{%artist}}`
        $this->addForeignKey(
            '{{%fk-album-artist_id}}',
            '{{%album}}',
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
        // drops foreign key for table `{{%band}}`
        $this->dropForeignKey(
            '{{%fk-album-band_id}}',
            '{{%album}}'
        );

        // drops index for column `band_id`
        $this->dropIndex(
            '{{%idx-album-band_id}}',
            '{{%album}}'
        );

        // drops foreign key for table `{{%artist}}`
        $this->dropForeignKey(
            '{{%fk-album-artist_id}}',
            '{{%album}}'
        );

        // drops index for column `artist_id`
        $this->dropIndex(
            '{{%idx-album-artist_id}}',
            '{{%album}}'
        );

        $this->dropTable('{{%album}}');
    }
}
