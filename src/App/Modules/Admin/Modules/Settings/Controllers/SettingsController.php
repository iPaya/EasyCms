<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Modules\Settings\Controllers;


use App\Modules\Admin\Modules\Settings\Actions\SettingsAction;
use App\Modules\Admin\Modules\Settings\Controller;
use App\Settings\CodeSettings;
use App\Settings\DefaultHomePageSettings;
use App\Settings\MailSettings;
use App\Settings\SiteSettings;
use yii\helpers\Html;

class SettingsController extends Controller
{
    public function actions()
    {
        return [
            'site' => [
                'class' => SettingsAction::class,
                'modelClass' => SiteSettings::class,
                'viewName' => 'site',
            ],
            'code' => [
                'class' => SettingsAction::class,
                'modelClass' => CodeSettings::class,
                'viewName' => 'code',
            ],
            'mail' => [
                'class' => SettingsAction::class,
                'modelClass' => MailSettings::class,
                'viewName' => 'mail',
            ],
            'default-home-page' => [
                'class' => SettingsAction::class,
                'modelClass' => DefaultHomePageSettings::class,
                'viewName' => 'default-home-page',
            ],
        ];
    }

    public function actionTestMail()
    {
        $model = new MailSettings();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {

            try {
                $mailer = $model->createMailer();
                $result = $mailer->compose()
                    ->setTo([$model->email => $model->sender])
                    ->setSubject('测试邮件')
                    ->setTextBody('测试邮件能否发送成功')
                    ->send();

                if ($result) {
                    return $this->asJson([
                        'errorCode' => 0,
                        'html' => '<strong>发送成功</strong>',
                    ]);
                } else {
                    return $this->asJson([
                        'errorCode' => 0,
                        'html' => '<strong>发送失败</strong>，请检查 smtp 是否配置正确',
                    ]);
                }
            } catch (\Exception $exception) {
                return $this->asJson([
                    'errorCode' => 0,
                    'html' => '<strong>发送失败</strong>， 因为<br/>' . $exception->getMessage(),
                ]);
            }
        } else {
            return $this->asJson([
                'errorCode' => 0,
                'html' => Html::errorSummary($model)
            ]);
        }
    }
}
