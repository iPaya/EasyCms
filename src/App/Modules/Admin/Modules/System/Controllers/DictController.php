<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Modules\System\Controllers;

use App\Models\Dict;
use App\Models\DictItem;
use App\Modules\Admin\Controller;
use App\Modules\Admin\Modules\System\Models\DictSearch;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * DictController implements the CRUD actions for Dict model.
 */
class DictController extends Controller
{
    public function accessRules()
    {
        return [
            ['allow' => true, 'permissions' => ['permission_manageDict']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function verbs()
    {
        return [
            'delete' => ['POST'],
        ];
    }

    /**
     * Lists all Dict models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DictSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dict model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $items = $model->getItems()->orderBy(['sortNo' => SORT_ASC])->all();

        $itemModel = new DictItem([
            'dictId' => $model->id,
            'sortNo' => 0,
        ]);

        if ($itemModel->load(Yii::$app->request->post()) && $itemModel->save()) {
            dict_manager()->clean();
            return $this->refresh();
        }

        return $this->render('view', [
            'model' => $model,
            'itemModel' => $itemModel,
            'items' => $items,
        ]);
    }

    /**
     * Creates a new Dict model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dict();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Dict model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Dict model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Dict model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dict the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dict::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
