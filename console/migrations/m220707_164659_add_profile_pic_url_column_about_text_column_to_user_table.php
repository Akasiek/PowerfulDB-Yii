<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m220707_164659_add_profile_pic_url_column_about_text_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'profile_pic_url', $this->string(1024));
        $this->addColumn('{{%user}}', 'about_text', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'profile_pic_url');
        $this->dropColumn('{{%user}}', 'about_text');
    }
}
