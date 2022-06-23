<?php

use yii\db\Migration;

/**
 * Class m220623_153129_create_gin_index_on_artist
 */
class m220623_153129_create_gin_index_on_artist extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->execute("CREATE INDEX CONCURRENTLY index_artist_on_name_trigram ON artist USING gin (name gin_trgm_ops);");
        $this->execute("CREATE INDEX CONCURRENTLY index_artist_on_full_name_trigram ON artist USING gin (full_name gin_trgm_ops);");
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->execute("DROP INDEX CONCURRENTLY index_artist_on_name_trigram");
        $this->execute("DROP INDEX CONCURRENTLY index_artist_on_full_name_trigram");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220623_153129_create_gin_index_on_artist cannot be reverted.\n";

        return false;
    }
    */
}
