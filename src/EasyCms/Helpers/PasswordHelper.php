<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace EasyCms\Helpers;


class PasswordHelper
{
    /**
     * @param string $password
     * @param $salt
     * @return string
     */
    public static function generateHash(string $password, string $salt)
    {
        return md5($salt . md5($password . $salt) . $salt);
    }

    /**
     * @param string $password
     * @param string $hash
     * @param string $salt
     * @return bool
     */
    public static function validatePassword(string $password, string $hash, string $salt)
    {
        return self::generateHash($password, $salt) === $hash;
    }
}