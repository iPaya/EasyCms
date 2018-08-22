<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Widgets\UEditor;


use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

class UEditor extends InputWidget
{
    public $options = [
    ];
    public $clientOptions = [];

    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $view = $this->getView();
        UEditorAsset::register($view);
        $clientOptions = Json::encode($this->clientOptions);
        $view->registerJs("var ue = UE.getEditor('{$this->options['id']}', {$clientOptions});");
        echo $this->renderTextareaHtml();
    }

    protected function renderTextareaHtml()
    {
        if ($this->hasModel()) {
            return Html::activeTextarea($this->model, $this->attribute, $this->options);
        }
        return Html::textarea($this->name, $this->value, $this->options);
    }
}
