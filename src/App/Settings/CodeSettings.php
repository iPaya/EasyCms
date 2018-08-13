<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Settings;


class CodeSettings extends AbstractSettings
{
    public $head;
    public $foot;

    public static function sectionName(): string
    {
        return 'code';
    }

    public static function title(): string
    {
        return '嵌入代码';
    }

    public function rules()
    {
        return [
            [['head', 'foot'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'head' => '顶部代码',
            'foot' => '底部代码'
        ];
    }

    public function attributeHints()
    {
        return [
            'head' => '代码会放在 </head> 标签以上',
            'foot' => '代码会放在 </body> 标签以上'
        ];
    }
}
