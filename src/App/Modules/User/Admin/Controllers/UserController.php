<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\User\Admin\Controllers;

use App\Modules\User\Admin\Controller;
use App\Modules\User\Admin\Models\CreateUserForm;
use App\Modules\User\Admin\Models\ResetPasswordForm;
use App\Modules\User\Admin\Models\UserSearch;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findUser($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CreateUserForm();

        if ($model->load(Yii::$app->request->post()) && ($user = $model->create()) !== false) {
            return $this->redirect(['view', 'id' => $user->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findUser($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($id)
    {
        $user = $this->findUser($id);

        $model = ResetPasswordForm::from($user);

        if ($model->load(Yii::$app->request->post()) && $model->resetPassword()) {
            alert_manager()->success('重置成功');
            return $this->refresh();
        }

        return $this->render('reset-password', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    /**
     * @param $id
     * @param array $returnUrl
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionActive($id, $returnUrl = ['index'])
    {
        $this->findUser($id)->active();

        alert_manager()->success('激活成功');

        return $this->redirect($returnUrl);
    }

    /**
     * @param $id
     * @param array $returnUrl
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionLock($id, $returnUrl = ['index'])
    {
        $this->findUser($id)->lock();

        alert_manager()->success('锁定成功');

        return $this->redirect($returnUrl);
    }


}
