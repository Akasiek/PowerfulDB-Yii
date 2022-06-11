<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%artist}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m220607_180055_create_artist_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%artist}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(256)->notNull(),
            'slug' => $this->string(256)->notNull(),
            'full_name' => $this->string(256),
            'birth_date' => $this->date(),
            'death_date' => $this->date(),
            'bg_image_url' => $this->string(2048),
            'created_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'updated_by' => $this->integer(11),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-artist-created_by}}',
            '{{%artist}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-artist-created_by}}',
            '{{%artist}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-artist-updated_by}}',
            '{{%artist}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-artist-updated_by}}',
            '{{%artist}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-artist-created_by}}',
            '{{%artist}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-artist-created_by}}',
            '{{%artist}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-artist-updated_by}}',
            '{{%artist}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-artist-updated_by}}',
            '{{%artist}}'
        );

        $this->dropTable('{{%artist}}');
    }
}
