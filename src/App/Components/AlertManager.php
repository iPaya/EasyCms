<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Components;

use yii\base\Component;
use yii\di\Instance;
use yii\helpers\ArrayHelper;
use yii\web\Session;

class AlertManager extends Component
{
    /**
     * @var Session|array|string
     */
    public $session = 'session';

    public function init()
    {
        parent::init();
        $this->session = Instance::ensure($this->session, Session::class);
    }

    /**
     * @param string|array $messages
     */
    public function success($messages)
    {
        $this->set('success', $messages);
    }

    public function set($type, $messages)
    {
        if (is_string($messages)) {
            $messages = [$messages];
        }
        $flashes = $this->getFlashes($type);
        $flashes = ArrayHelper::merge($flashes, $messages);
        $this->setFlashes($type, $flashes);
    }

    /**
     * @param string $type
     * @return array
     */
    public function getFlashes($type)
    {
        return $this->session->getFlash($type, []);
    }

    /**
     * @param string $type
     * @param array $flashes
     */
    public function setFlashes($type, array $flashes)
    {
        return $this->session->setFlash($type, $flashes);
    }

    /**
     * @param string|array $messages
     */
    public function error($messages)
    {
        $this->set('error', $messages);
    }
}
