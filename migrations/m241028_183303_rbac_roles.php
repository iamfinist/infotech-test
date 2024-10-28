<?php

use yii\db\Migration;

/**
 * Class m241028_183303_rbac_roles
 */
class m241028_183303_rbac_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /** @var \yii\rbac\DbManager $auth */
        $auth = Yii::$app->authManager;
        $adminRole = $auth->createRole('admin');
        $auth->add($adminRole);
        $auth->assign($adminRole, 1);
        $userRole = $auth->createRole('user');
        $auth->add($userRole);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241028_183303_rbac_roles cannot be reverted.\n";

        return false;
    }
    */
}
