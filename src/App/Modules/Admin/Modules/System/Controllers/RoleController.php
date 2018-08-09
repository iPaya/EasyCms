<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Modules\System\Controllers;


use App\Modules\Admin\Controller;
use App\Modules\Admin\Modules\System\Models\RoleForm;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class RoleController extends Controller
{
    public function verbs()
    {
        return [
            'delete' => ['POST']
        ];
    }

    public function actionIndex()
    {
        $authManager = auth_manager();
        $roles = $authManager->getRoles();

        $dataProvider = new ArrayDataProvider([
            'allModels' => $roles,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new RoleForm([
            'name' => 'role_' . \Yii::$app->security->generateRandomString(8)
        ]);

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->refresh();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($name)
    {
        $role = auth_manager()->getRole($name);
        if ($role == null) {
            throw new NotFoundHttpException();
        }

        $model = new RoleForm([
            'name' => $name,
            'description' => $role->description,
        ]);

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->refresh();
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionPermissions($name)
    {
        $authManager = auth_manager();
        $model = $authManager->getRole($name);
        if ($model == null) {
            throw new NotFoundHttpException();
        }

        $permissions = ArrayHelper::map($authManager->getPermissions(), 'name', 'description');
        $rolePermissions = ArrayHelper::map($authManager->getPermissionsByRole($model->name), 'name', 'description');

        $request = \Yii::$app->request;
        if ($request->isPost) {
            $newPermissions = $request->post('permissions', []);
            $authManager->removeChildren($model);
            foreach ($newPermissions as $name) {
                $permission = $authManager->getPermission($name);
                $authManager->addChild($model, $permission);
            }

            return $this->refresh();
        }

        return $this->render('permissions', [
            'model' => $model,
            'rolePermissions' => $rolePermissions,
            'permissions' => $permissions,
        ]);

    }

    /**
     * @param $name
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionDelete($name)
    {
        $authManager = auth_manager();
        $model = $authManager->getRole($name);
        if ($model == null) {
            throw new NotFoundHttpException();
        }

        $authManager->remove($model);
        return $this->redirect(['index']);
    }
}
