<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Modules\Account\Controllers;


use App\Models\Manager;
use App\Modules\Admin\Controller;
use App\Modules\Admin\Modules\Account\Models\ChangePasswordForm;

class SecurityController extends Controller
{
    public function actionChangePassword()
    {
        /** @var Manager $manager */
        $manager = \Yii::$app->user->getIdentity();

        $model = new ChangePasswordForm([
            'manager' => $manager,
        ]);

        if ($model->load(\Yii::$app->request->post()) && $model->changePassword()) {
            return $this->refresh();
        }

        return $this->render('change-password', [
            'model' => $model,
        ]);
    }
}
