<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Modules\File\Controllers;


use App\Models\File;
use App\Modules\Admin\Modules\File\Controller;
use yii\data\ActiveDataProvider;

class ImageController extends Controller
{
    public function actionIndex()
    {
        $query = File::find()->andWhere([
            'type' => 'image',
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
