<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use yii\db\Migration;
use yii\rbac\Permission;

/**
 * Class m180814_021627_add_permission_manageUser
 */
class m180814_011627_add_permission_manageUser extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $permissions = [
            'permission_manageUser' => '管理用户',
        ];

        $authManager = auth_manager();
        foreach ($permissions as $name => $description) {
            $authManager->add(new Permission(['name' => $name, 'description' => $description]));
        }

        $rolePermissions = [
            'role_superManager' => [
                'permission_manageUser',
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
        $authManager->remove($authManager->getPermission('permission_manageUser'));
    }
}
