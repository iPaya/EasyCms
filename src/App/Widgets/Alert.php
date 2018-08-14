<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Widgets;


use App\Components\AlertManager;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class Alert extends Widget
{
    /**
     * @var AlertManager
     */
    public $alertManager;

    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - key: the name of the session flash variable
     * - value: the bootstrap alert type (i.e. danger, success, info, warning)
     */
    public $alertTypes = [
        'error' => 'alert-danger',
        'danger' => 'alert-danger',
        'success' => 'alert-success',
        'info' => 'alert-info',
        'warning' => 'alert-warning',
        'secondary' => 'alert-secondary',
        'light' => 'alert-light',
        'dark' => 'alert-dark'
    ];
    public $options = [];

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();
        $appendClass = isset($this->options['class']) ? ' ' . $this->options['class'] : ' alert alert-dismissible';

        foreach ($flashes as $type => $flash) {
            if (!isset($this->alertTypes[$type])) {
                continue;
            }

            foreach ((array)$flash as $i => $message) {
                echo Html::beginTag('div', array_merge($this->options, [
                    'id' => $this->getId() . '-' . $type . '-' . $i,
                    'class' => $this->alertTypes[$type] . $appendClass,
                ]));

                $messages = $this->alertManager->getFlashes($type);
                echo implode($messages, "\n");

                echo Html::button('<span aria-hidden="true">&times;</span>', [
                    'class' => 'close',
                    'data-dismiss' => 'alert',
                    'aria-label' => 'Close'
                ]);
                echo Html::endTag('div');
            }

            $session->removeFlash($type);
        }
    }

}
