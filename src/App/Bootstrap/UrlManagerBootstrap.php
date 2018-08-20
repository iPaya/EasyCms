<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Bootstrap;


use App\Settings\DefaultHomePageSettings;
use yii\base\BootstrapInterface;

class UrlManagerBootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $defaultHomePageSettings = DefaultHomePageSettings::getInstance();

        if ($defaultHomePageSettings->targetRoute) {
            $app->urlManager->addRules([
                '/' => $defaultHomePageSettings->targetRoute,
            ]);
        }
    }

}
