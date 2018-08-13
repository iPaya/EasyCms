<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Widgets;


use yii\base\Widget;
use yii\helpers\Html;

class Alert extends Widget
{
    /**
     * @var string
     */
    public $message;
    public $type = 'primary';
    public $options = [];
    /**
     * @var bool 是否可关闭
     */
    public $dismissible = false;
    public $dismissLabel = '<span aria-hidden="true">&times;</span>';

    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        Html::addCssClass($this->options, ['alert', 'alert-' . $this->type]);
        $this->options['role'] = 'alert';

        if ($this->dismissible) {
            Html::addCssClass($this->options, ['alert-dismissible']);
        }

        echo Html::beginTag('div', $this->options);

        ob_start();
        ob_implicit_flush(false);
    }

    public function run()
    {
        parent::run();
        $contents = ob_get_clean();

        if ($this->dismissible) {
            echo Html::tag('button', $this->dismissLabel, [
                'type' => 'button',
                'class' => 'close',
                'data-dismiss' => 'alert',
                'aria-label' => '关闭'
            ]);
        }

        if ($this->message) {
            echo $this->message;
        } else {
            echo $contents;
        }

        echo Html::endTag('div');
    }
}
