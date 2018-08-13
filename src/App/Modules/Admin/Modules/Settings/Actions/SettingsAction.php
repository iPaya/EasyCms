<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Modules\Settings\Actions;


use App\Settings\AbstractSettings;
use pheme\settings\components\Settings;
use Yii;
use yii\base\Action;

class SettingsAction extends Action
{
    /**
     * @var string class name of the model which will be used to validate the attributes.
     * The class should have a scenario matching the `scenario` variable.
     * The model class must implement [[Model]].
     * This property must be set.
     */
    public $modelClass;

    /**
     * @var string The scenario this model should use to make validation
     */
    public $scenario;

    /**
     * @var string the name of the view to generate the form. Defaults to 'settings'.
     */
    public $viewName = 'settings';

    /**
     * Render the settings form.
     */
    public function run()
    {
        /** @var Settings $settings */
        $settings = Yii::$app->settings;
        /* @var $model AbstractSettings */
        $model = new $this->modelClass();
        if ($this->scenario) {
            $model->setScenario($this->scenario);
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            foreach ($model->toArray() as $key => $value) {
                $settings->set($key, $value, $this->modelClass::sectionName(), 'string');
            }
            return $this->controller->refresh();
        }
        foreach ($model->attributes() as $key) {
            $model->{$key} = $settings->get($key, $this->modelClass::sectionName());
        }
        return $this->controller->render($this->viewName, ['model' => $model]);
    }
}
