<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

$db_host = getenv('DB_HOST');
$db_name = getenv('DB_NAME');
$db_username = getenv('DB_USERNAME');
$db_password = getenv('DB_PASSWORD');

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=' . $db_host . ';dbname=' . $db_name,
    'username' => $db_username,
    'password' => $db_password,
    'charset' => 'utf8',
    'tablePrefix' => 'tbl_'
];
