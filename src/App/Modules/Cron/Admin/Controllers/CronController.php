<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Cron\Admin\Controllers;

use App\Models\Cron;
use App\Modules\Cron\Admin\Controller;
use App\Modules\Cron\Admin\Models\CronSearch;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * CronController implements the CRUD actions for Cron model.
 */
class CronController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function verbs()
    {
        return [
            'delete' => ['POST'],
            'enable' => ['POST'],
            'disable' => ['POST'],
        ];
    }

    /**
     * Lists all Cron models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CronSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cron model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Cron model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cron the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cron::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new Cron model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cron();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cron model.
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
     * Deletes an existing Cron model.
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
     * @param $id
     * @param array $returnUrl
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionEnable($id, $returnUrl = ['index'])
    {
        $this->findModel($id)->enable();

        return $this->redirect($returnUrl);
    }

    /**
     * @param $id
     * @param array $returnUrl
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionDisable($id, $returnUrl = ['index'])
    {
        $model = $this->findModel($id);
        $model->disable();

        return $this->redirect($returnUrl);
    }

    /**
     * @param $id
     * @param $returnUrl
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionPush($id, $returnUrl)
    {
        $model = $this->findModel($id);
        $job = $model->createJob();
        if (queue()->push($job)) {
            alert_manager()->success('已添加到队列');
            return $this->redirect($returnUrl);
        }


    }
}
