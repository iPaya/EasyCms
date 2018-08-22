<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Post\Admin\Controllers;

use App\Models\PostCategory;
use App\Modules\Post\Admin\Controller;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * CategoryController implements the CRUD actions for PostCategory model.
 */
class CategoryController extends Controller
{
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
     * @return string
     */
    public function actionIndex()
    {
        $models = PostCategory::find()->andWhere(['parentId' => 0])->all();
        $items = [];
        foreach ($models as $model) {
            $items[] = [
                'label' => $model->name,
                'items' => $model->treeViewItems(),
                'links' => [
                    ['label' => '添加子分类', 'url' => ['create', 'parentId' => $model->id]],
                    ['label' => '编辑', 'url' => ['update', 'id' => $model->id]],
                ]
            ];
        }

        return $this->render('index', [
            'models' => $models,
            'items' => $items,
        ]);
    }

    /**
     * Displays a single PostCategory model.
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
     * Finds the PostCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PostCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PostCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param int $parentId
     * @return string|\yii\web\Response
     */
    public function actionCreate($parentId = 0)
    {
        $model = new PostCategory([
            'parentId' => $parentId,
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PostCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PostCategory model.
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
}
