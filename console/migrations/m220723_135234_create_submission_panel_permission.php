<?php

use yii\db\Migration;

/**
 * Class m220723_135234_create_submission_panel_permission
 */
class m220723_135234_create_submission_panel_permission extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $auth = Yii::$app->authManager;
        // add "submissionPanel" permission
        $submissionPanel = $auth->createPermission('submissionPanel');
        $submissionPanel->description = 'Access to submission panel';
        $auth->add($submissionPanel);

        // add admin role to "submissionPanel" permission
        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $submissionPanel);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $auth = Yii::$app->authManager;
        $submissionPanel = $auth->getPermission('submissionPanel');
        $auth->remove($submissionPanel);
    }
}
