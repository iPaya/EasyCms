<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Modules\File\Controllers;


use App\Models\FileDir;
use App\Modules\Admin\Modules\File\Controller;

class DirController extends Controller
{
    /**
     * @param $id
     * @param array $returnUrl
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionCreate($id, $returnUrl = ['file/index'])
    {
        $dir = $this->findDir($id);

        $model = new FileDir([
            'parentId' => $dir->id
        ]);

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect($returnUrl);
        }

        return $this->render('create', [
            'dir' => $dir,
            'model' => $model,
        ]);
    }
}
