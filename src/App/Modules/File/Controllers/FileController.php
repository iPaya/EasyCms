<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\File\Controllers;


use App\Modules\File\Controller;

class FileController extends Controller
{
    /**
     * @param $id
     * @return \yii\console\Response|\yii\web\Response
     * @throws \League\Flysystem\FileNotFoundException
     * @throws \yii\web\NotFoundHttpException
     * @throws \yii\web\RangeNotSatisfiableHttpException
     */
    public function actionView($id)
    {
        $model = $this->findFile($id);
        $raw = $model->raw;
        $contents = $raw->read();

        return \Yii::$app->response->sendContentAsFile($contents, $raw->filename, [
            'mimeType' => $raw->mimeType,
            'inline' => (
                $model->type == 'image'
            )
        ]);
    }
}
