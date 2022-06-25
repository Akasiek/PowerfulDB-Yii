<?php

use yii\db\Migration;

/**
 * Class m220623_153709_create_gin_index_on_band
 */
class m220623_153709_create_gin_index_on_band extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->execute("CREATE INDEX CONCURRENTLY index_band_on_name_trigram ON band USING gin (name gin_trgm_ops);");
        $this->execute("CREATE INDEX CONCURRENTLY index_band_on_slug_trigram ON band USING gin (slug gin_trgm_ops);");
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->execute("DROP INDEX CONCURRENTLY index_band_on_name_trigram");
        $this->execute("DROP INDEX CONCURRENTLY index_band_on_slug_trigram");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220623_153709_create_gin_index_on_band cannot be reverted.\n";

        return false;
    }
    */
}
