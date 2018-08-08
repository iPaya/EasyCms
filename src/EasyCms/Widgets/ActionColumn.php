<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace EasyCms\Widgets;

use yii\helpers\Html;

class ActionColumn extends \yii\grid\ActionColumn
{
    /**
     * Initializes the default button rendering callbacks.
     */
    protected function initDefaultButtons()
    {
        $this->initDefaultButton('view');
        $this->initDefaultButton('update');
        $this->initDefaultButton('delete', null, [
            'data-confirm' => '确认删除此项',
            'data-method' => 'post',
        ]);
    }

    /**
     * @param string $name
     * @param null $label
     * @param array $additionalOptions
     */
    protected function initDefaultButton($name, $label = null, $additionalOptions = [])
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $label, $additionalOptions) {
                switch ($name) {
                    case 'view':
                        $title = $label ?? '查看';
                        break;
                    case 'update':
                        $title = $label ?? '修改';
                        break;
                    case 'delete':
                        $title = $label ?? '删除';
                        break;
                    default:
                        $title = ucfirst($name);
                }
                $options = array_merge([
                    'title' => $title,
                    'aria-label' => $title,
                    'data-pjax' => '0',
                ], $additionalOptions, $this->buttonOptions);
                return Html::a($title, $url, $options);
            };
        }
    }
}