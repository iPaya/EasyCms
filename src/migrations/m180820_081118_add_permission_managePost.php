<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use App\Components\Migration;
use yii\rbac\Permission;


/**
 * Class m180820_081118_add_permission_managePost
 */
class m180820_081118_add_permission_managePost extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $permissions = [
            'permission_managePost' => '管理文章',
        ];

        $authManager = auth_manager();
        foreach ($permissions as $name => $description) {
            $authManager->add(new Permission(['name' => $name, 'description' => $description]));
        }

        $rolePermissions = [
            'role_superManager' => [
                'permission_managePost',
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
        $authManager->remove($authManager->getPermission('permission_managePost'));
    }
}
