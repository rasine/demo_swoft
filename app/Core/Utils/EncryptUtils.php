<?php

/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://doc.swoft.org
 * @contact  limingxin@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Core\Utils;

/**
 * Class ErrorCode
 * @package App\Constants
 */
class EncryptUtils
{
    /**
     * 获取最终加密密码
     * @param $pwFromClient
     * @param $salt
     * @param string $fixSalt
     * @return string
     */
    static function getLastPw($pwFromClient, $salt, $fixSalt = "")
    {
        $fixSalt = ($fixSalt != "") ? $fixSalt : strtotime(date(("Y-m-d H:i:s"), time()));
        return strtoupper(md5(md5($pwFromClient . $salt) . $fixSalt . "getLastPw"));
    }

    /**
     * [生成随机字符串]
     * @param  integer $length [生成的长度]
     * @param  integer $type [生成的类型]
     * @return [type]   str       [description]
     * @php 随机码类型：0，数字+大写字母；1，数字；2，小写字母；3，大写字母；4，特殊字符；-1，数字+大小写字母+特殊字符
     */
    static function randCode($length = 5, $type = 0)
    {
        $arr = array(1 => "0123456789", 2 => "abcdefghijklmnopqrstuvwxyz", 3 => "ABCDEFGHIJKLMNOPQRSTUVWXYZ", 4 => "~@#$%^&*(){}[]|");
        $code = "";
        if ($type == 0) {
            array_pop($arr);
            $string = implode("", $arr);
        } else if ($type == "-1") {
            $string = implode("", $arr);
        } else {
            $string = $arr[$type];
        }
        $count = strlen($string) - 1;
        for ($i = 0; $i < $length; $i++) {
            $str[$i] = $string[rand(0, $count)];
            $code .= $str[$i];
        }
        return $code;
    }

    /**
     * 生成不重复的随机码
     * @param $len
     * @return int|mixed
     */
    static function randNoRepeatCode($str = "", $len = 64)
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
        $string = ($str == "") ? uniqid() : $str;
        $len = $len - strlen($string);
        for (; $len >= 1; $len--) {
            $position = rand() % strlen($chars);
            $position2 = rand() % strlen($string);
            $string = substr_replace($string, substr($chars, $position, 1), $position2, 0);
        }
        return $string;
    }

    /**
     * 获取微秒数
     * @return float
     */
    static function getMicroSecond()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

    /**
     * 生成唯一标识字符串
     * @param string $namespace
     * @return mixed
     */
    public static function create_guid($namespace = '')
    {
        static $guid = '';
        $uid = uniqid("", true);
        $data = $namespace;
        $data .= self::getMicroSecond();
        $data .= mt_rand(1, 99999999);
        $data .= microtime();
        $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
        $guid = substr($hash, 0, 8) .
            '-' .
            substr($hash, 8, 4) .
            '-' .
            substr($hash, 12, 4) .
            '-' .
            substr($hash, 16, 4) .
            '-' .
            substr($hash, 20, 12);
        return str_replace("-", "", $guid);
    }
}