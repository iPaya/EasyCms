<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Modules\System\Controllers;


use App\Modules\Admin\Controller;
use App\Modules\Admin\Modules\System\Models\PermissionForm;
use yii\data\ArrayDataProvider;
use yii\web\NotFoundHttpException;

class PermissionController extends Controller
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
        $permissions = $authManager->getPermissions();

        $dataProvider = new ArrayDataProvider([
            'allModels' => $permissions,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new PermissionForm([
            'name' => \Yii::$app->security->generateRandomString(8)
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
        $permission = auth_manager()->getPermission($name);
        if ($permission == null) {
            throw new NotFoundHttpException();
        }

        $model = new PermissionForm([
            'name' => $name,
            'description' => $permission->description,
        ]);

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->refresh();
        }

        return $this->render('update', [
            'model' => $model,
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
        $permission = $authManager->getPermission($name);
        if ($permission == null) {
            throw new NotFoundHttpException();
        }

        $authManager->remove($permission);
        return $this->redirect(['index']);
    }
}