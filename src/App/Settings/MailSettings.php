<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Settings;


use yii\swiftmailer\Mailer;

class MailSettings extends AbstractSettings
{
    public $sender;
    public $email;
    public $password;
    public $smtp;
    public $port = 25;
    public $encryption = 'tls';


    public static function sectionName(): string
    {
        return 'mail';
    }

    public static function title(): string
    {
        return '发送邮件设置';
    }

    public function rules()
    {
        return [
            ['sender', 'string'],
            ['email', 'email'],
            ['password', 'string'],
            ['smtp', 'string'],
            ['port', 'integer'],
            ['encryption', 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'sender' => '发件人',
            'email' => '邮箱',
            'password' => '账号',
            'smtp' => 'SMTP',
            'port' => '端口',
            'encryption' => '加密'
        ];
    }

    /**
     * @return Mailer
     */
    public function createMailer(): Mailer
    {
        $mailer = new Mailer([
            'useFileTransport' => !YII_DEBUG,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => $this->smtp,
                'username' => $this->email,
                'password' => $this->password,
                'port' => $this->port,
                'encryption' => $this->encryption
            ],
            'messageConfig' => [
                'from' => [$this->email => $this->sender]
            ]
        ]);

        return $mailer;
    }
}
