<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Modules\File;


use App\Models\FileDir;
use yii\web\NotFoundHttpException;

class Controller extends \App\Controller
{
    public function accessRules()
    {
        return [
            ['allow' => true, 'permissions' => ['permission_manageFile']]
        ];
    }

    /**
     * @param $id
     * @return FileDir|null
     * @throws NotFoundHttpException
     */
    protected function findDir($id){
        if (($model = FileDir::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
