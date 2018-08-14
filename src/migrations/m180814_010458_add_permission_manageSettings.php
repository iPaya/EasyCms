<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

use yii\db\Migration;
use yii\rbac\Permission;

/**
 * Class m180814_012458_add_permission_manageSettings
 */
class m180814_010458_add_permission_manageSettings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $permissions = [
            'permission_manageSettings' => '管理设置',
        ];

        $authManager = auth_manager();
        foreach ($permissions as $name => $description) {
            $authManager->add(new Permission(['name' => $name, 'description' => $description]));
        }

        $rolePermissions = [
            'role_superManager' => [
                'permission_manageSettings',
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
        $authManager->remove($authManager->getPermission('permission_manageSettings'));
    }

}
