<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%band_member}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%artist}}`
 * - `{{%band}}`
 */
class m220620_133628_create_band_member_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%band_member}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'artist_id' => $this->integer(),
            'band_id' => $this->integer(),
        ]);

        // creates index for column `artist_id`
        $this->createIndex(
            '{{%idx-band_member-artist_id}}',
            '{{%band_member}}',
            'artist_id'
        );

        // add foreign key for table `{{%artist}}`
        $this->addForeignKey(
            '{{%fk-band_member-artist_id}}',
            '{{%band_member}}',
            'artist_id',
            '{{%artist}}',
            'id',
            'CASCADE'
        );

        // creates index for column `band_id`
        $this->createIndex(
            '{{%idx-band_member-band_id}}',
            '{{%band_member}}',
            'band_id'
        );

        // add foreign key for table `{{%band}}`
        $this->addForeignKey(
            '{{%fk-band_member-band_id}}',
            '{{%band_member}}',
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
        // drops foreign key for table `{{%artist}}`
        $this->dropForeignKey(
            '{{%fk-band_member-artist_id}}',
            '{{%band_member}}'
        );

        // drops index for column `artist_id`
        $this->dropIndex(
            '{{%idx-band_member-artist_id}}',
            '{{%band_member}}'
        );

        // drops foreign key for table `{{%band}}`
        $this->dropForeignKey(
            '{{%fk-band_member-band_id}}',
            '{{%band_member}}'
        );

        // drops index for column `band_id`
        $this->dropIndex(
            '{{%idx-band_member-band_id}}',
            '{{%band_member}}'
        );

        $this->dropTable('{{%band_member}}');
    }
}
