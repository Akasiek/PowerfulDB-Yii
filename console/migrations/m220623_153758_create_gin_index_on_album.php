<?php

use yii\db\Migration;

/**
 * Class m220623_153758_create_gin_index_on_album
 */
class m220623_153758_create_gin_index_on_album extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->execute("CREATE INDEX CONCURRENTLY index_album_on_title_trigram ON album USING gin (title gin_trgm_ops);");
        $this->execute("CREATE INDEX CONCURRENTLY index_album_on_slug_trigram ON album USING gin (slug gin_trgm_ops);");
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->execute("DROP INDEX CONCURRENTLY index_album_on_title_trigram");
        $this->execute("DROP INDEX CONCURRENTLY index_album_on_slug_trigram");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220623_153758_create_gin_index_on_album cannot be reverted.\n";

        return false;
    }
    */
}
