<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Components\Migration;
use yii\rbac\Permission;
use yii\rbac\Role;

/**
 * Class m180809_070147_init_rbac
 */
class m180808_070147_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $permissions = [
            'permission_manageRbac' => '管理 RBAC',
            'permission_manageManager' => '管理管理员',
            'permission_manageDict' => '管理字典',
        ];
        $roles = [
            'role_superManager' => '超级管理员',
            'role_manager' => '一般管理员',
        ];
        $rolePermissions = [
            'role_superManager' => [
                'permission_manageRbac',
                'permission_manageManager',
                'permission_manageDict',
            ],
            'role_manager' => [
                'permission_manageDict',
            ],
        ];

        $authManager = auth_manager();
        foreach ($permissions as $name => $description) {
            $authManager->add(new Permission(['name' => $name, 'description' => $description]));
        }

        foreach ($roles as $name => $description) {
            $authManager->add(new Role(['name' => $name, 'description' => $description]));
        }

        foreach ($rolePermissions as $role => $permissions) {
            $role = $authManager->getRole($role);
            foreach ($permissions as $permission) {
                $authManager->addChild($role, $authManager->getPermission($permission));
            }
        }

        $authManager->assign($authManager->getRole('role_superManager'), 1);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        auth_manager()->removeAll();
    }

}
