<?php

use yii\db\Migration;

/**
 * Class m220623_153055_install_pg_trgm_extension
 */
class m220623_153055_install_pg_trgm_extension extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("CREATE EXTENSION IF NOT EXISTS pg_trgm");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220623_153055_install_pg_trgm_extension cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220623_153055_install_pg_trgm_extension cannot be reverted.\n";

        return false;
    }
    */
}
