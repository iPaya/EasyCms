<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Modules\Account\Controllers;


use App\Models\Manager;
use App\Modules\Admin\Controller;
use App\Modules\Admin\Modules\Account\Models\ProfileForm;

class ProfileController extends Controller
{
    public function actionIndex()
    {
        /** @var Manager $manager */
        $manager = \Yii::$app->user->getIdentity();
        $model = new ProfileForm(['manager' => $manager]);

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->refresh();
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }
}
