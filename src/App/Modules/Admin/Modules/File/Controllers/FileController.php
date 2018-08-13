<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Modules\File\Controllers;

use App\Models\File;
use App\Models\FileDir;
use App\Modules\Admin\Modules\File\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * FileController implements the CRUD actions for File model.
 */
class FileController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function verbs()
    {
        return [
            'delete' => ['POST'],
            'upload' => ['POST']
        ];
    }

    /**
     * Lists all File models.
     * @return mixed
     */
    public function actionIndex($dir = 1)
    {
        $dir = $this->findDir($dir);

        $dirs = FileDir::find()->andWhere(['parentId' => $dir->id])->orderBy(['name' => SORT_ASC])->all();
        $files = File::find()->andWhere(['dirId' => $dir->id])->all();

        $models = array_merge($dirs, $files);

        return $this->render('index', [
            'dir' => $dir,
            'models' => $models,
        ]);
    }

    /**
     * @param int $dir
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpload($dir = 1)
    {
        $dir = $this->findDir($dir);

        $uploadedFile = UploadedFile::getInstanceByName('file');
        if ($uploadedFile == null) {
            return $this->asJson(['errorCode' => 1,'errorMessage'=>'未上传文件']);
        }

        $file = File::find()
            ->alias('t')
            ->leftJoin(['t2' => '{{%file_raw}}'], 't.rawId=t2.id')
            ->andWhere(['t2.filename' => $uploadedFile->name, 'dirId' => $dir->id])
            ->one();

        if ($file) {
            return $this->asJson([
                'errorCode' => 1,
                'errorMessage' => '文件已存在'
            ]);
        }

        $file = File::uploadContents($dir, $uploadedFile->name, file_get_contents($uploadedFile->tempName), $uploadedFile->type);

        if ($file == false) {
            return $this->asJson([
                'errorCode' => 1,
                'errorMessage' => '上传失败'
            ]);
        } else {
            return $this->asJson([
                'errorCode' => 0,
                'file' => $file,
            ]);
        }
    }

    /**
     * Displays a single File model.
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
     * Finds the File model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return File the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = File::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
