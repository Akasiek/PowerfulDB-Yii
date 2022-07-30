<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%edit_submission}}`.
 */
class m220730_165447_add_new_article_column_old_article_column_to_edit_submission_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%edit_submission}}', 'new_article', $this->text());
        $this->addColumn('{{%edit_submission}}', 'old_article', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%edit_submission}}', 'new_article');
        $this->dropColumn('{{%edit_submission}}', 'old_article');
    }
}
