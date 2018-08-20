<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use yii\db\Migration;
use yii\rbac\Permission;

/**
 * Class m180815_041752_add_permission_manageCron
 */
class m180815_041752_add_permission_manageCron extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $permissions = [
            'permission_manageCron' => '管理定时任务',
        ];

        $authManager = auth_manager();
        foreach ($permissions as $name => $description) {
            $authManager->add(new Permission(['name' => $name, 'description' => $description]));
        }

        $rolePermissions = [
            'role_superManager' => [
                'permission_manageCron',
            ],
        ];

        foreach ($rolePermissions as $role => $permissions) {
            $role = $authManager->getRole($role);
            foreach ($permissions as $permission) {
                $authManager->addChild($role, $authManager->getPermission($permission));
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $authManager = auth_manager();
        $authManager->remove($authManager->getPermission('permission_manageCron'));
    }
}
