<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Components\Migration;
use yii\rbac\Permission;

/**
 * Class m180810_071337_add_file_manage_permission
 */
class m180810_071337_add_file_manage_permission extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $permissions = [
            'permission_manageFile' => '管理文件',
        ];

        $authManager = auth_manager();
        foreach ($permissions as $name => $description) {
            $authManager->add(new Permission(['name' => $name, 'description' => $description]));
        }

        $rolePermissions = [
            'role_superManager' => [
                'permission_manageFile',
            ],
            'role_manager' => [
                'permission_manageFile',
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
        $authManager->remove($authManager->getPermission('permission_manageFile'));
    }

}
