<?php

use yii\db\Migration;

/**
 * Class m220707_161526_init_rbac
 */
class m220707_161526_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "adminPanel" permission
        $adminPanel = $auth->createPermission('adminPanel');
        $adminPanel->description = 'Admin panel';
        $auth->add($adminPanel);

        // add "admin" role and give this role the "adminPanel" permission
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $adminPanel);

        // assign "admin" role to user with id 1
        $auth->assign($admin, 1);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }
}
