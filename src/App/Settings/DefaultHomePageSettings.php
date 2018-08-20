<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Settings;


class DefaultHomePageSettings extends AbstractSettings
{
    public $targetRoute;

    public static function title(): string
    {
        return '默认首页';
    }

    public static function sectionName(): string
    {
        return 'defaultHomePage';
    }

    public function rules()
    {
        return [
            ['targetRoute', 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'targetRoute' => '目标路由'
        ];
    }

}
