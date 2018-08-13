<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\File;


use App\Models\File;
use yii\web\NotFoundHttpException;

class Controller extends \App\Controller
{
    /**
     * @param $id
     * @return File|null
     * @throws NotFoundHttpException
     */
    protected function findFile($id)
    {
        if (($model = File::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
