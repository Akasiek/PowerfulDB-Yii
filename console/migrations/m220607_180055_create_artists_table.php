<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%artists}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m220607_180055_create_artists_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%artists}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(256)->notNull(),
            'slug' => $this->string(256)->notNull(),
            'bg_image_url' => $this->string(2048),
            'created_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'updated_by' => $this->integer(11),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-artists-created_by}}',
            '{{%artists}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-artists-created_by}}',
            '{{%artists}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-artists-updated_by}}',
            '{{%artists}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-artists-updated_by}}',
            '{{%artists}}',
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
            '{{%fk-artists-created_by}}',
            '{{%artists}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-artists-created_by}}',
            '{{%artists}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-artists-updated_by}}',
            '{{%artists}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-artists-updated_by}}',
            '{{%artists}}'
        );

        $this->dropTable('{{%artists}}');
    }
}
