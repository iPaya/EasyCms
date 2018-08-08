<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Controllers;


use App\Modules\Admin\Controller;
use App\Modules\Admin\Models\LoginForm;
use yii\captcha\CaptchaAction;

class DefaultController extends Controller
{
    public function accessRules()
    {
        return [
            ['allow' => true, 'actions' => ['login', 'captcha']],
            ['allow' => true, 'roles' => ['@']],
        ];
    }

    public function actions()
    {
        return [
            'captcha' => [
                'class' => CaptchaAction::class,
                'height' => 40,
                'width' => 80,
                'minLength' => 4,
                'maxLength' => 4,
                'transparent' => true,
                'foreColor' => 0x007BFF
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goBack();
        }
        $this->layout = 'main-login';
        $model = new LoginForm();

        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();
        return $this->redirect(module_url($this->module,['default/index']));
    }
}