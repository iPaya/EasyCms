<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace EasyCms;


use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class Controller extends \yii\web\Controller
{
    /**
     * @return null|array
     */
    public function accessRules()
    {
        return null;
    }

    /**
     * @return array
     */
    public function verbs()
    {
        return [];
    }

    public function trustActions()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $accessRules = $this->accessRules();
        if ($accessRules) {
            $behaviors[] = [
                'class' => AccessControl::class,
                'rules' => $accessRules,
            ];
        }

        $behaviors[] = [
            'class' => VerbFilter::class,
            'actions' => $this->verbs(),
        ];

        return $behaviors;
    }

    public function beforeAction($action)
    {
        if (in_array($action->id, $this->trustActions())) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
}