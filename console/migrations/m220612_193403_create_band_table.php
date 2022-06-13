<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%band}}`.
 */
class m220612_193403_create_band_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%band}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'founding_year' => $this->integer(4),
            'breakup_year' => $this->integer(4),
            'bg_image_url' => $this->string(2048),
            'created_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'updated_by' => $this->integer(11),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%band}}');
    }
}
