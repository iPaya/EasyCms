<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Settings;


class SiteSettings extends AbstractSettings
{
    public $name;
    public $keywords;
    public $description;
    public $icp;

    /**
     * @inheritdoc
     */
    public static function sectionName(): string
    {
        return 'site';
    }

    /**
     * @inheritdoc
     */
    public static function title(): string
    {
        return '站点信息';
    }

    public function rules()
    {
        return [
            [['name', 'keywords', 'description'], 'required'],
            ['name', 'string', 'min' => 2, 'max' => 80],
            ['keywords', 'string', 'max' => 100],
            ['description', 'string', 'max' => 200],
            ['icp', 'string']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '网站名称',
            'keywords' => '网站关键字',
            'description' => '网站描述',
            'icp' => 'ICP 备案号',
        ];
    }
}
