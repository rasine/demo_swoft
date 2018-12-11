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
class CommUtils
{
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
     * 时间戳转化为标准时间
     * @param null $strTime
     * @return false|string
     */
    public static function timestamp2time($strTime = null)
    {
        date_default_timezone_set('PRC');
        $strTime = isset($strTime) ? $strTime : time();
        return date("Y-m-d H:i:s", $strTime);
    }

    /**
     * 标准时间转化为时间戳
     * @param null $strTime
     * @return false|int
     */
    public static function time2timestamp($strTime = null)
    {
        $strTime = isset($strTime) ? $strTime : date(("Y-m-d H:i:s"), time());
        return strtotime($strTime);
    }

    /**
     * 获取一个字符串
     * @param $v
     * @param string $df
     * @return string
     */
    public static function getValue($v = '', $df = "")
    {
        $v = isset($v) ? $v : $df;
        $v = trim($v);
        return (string)$v;
    }

    /**
     * 获取一个整形数
     * @param $v
     * @param int $df
     * @return int
     */
    public static function getValueI($v, $df = 0)
    {
        $v = isset($v) ? $v : $df;
        return (int)$v;
    }

    /**
     * 获取一个精确到一定位数的浮点数
     *
     * @param $num
     * @param int $double
     * @return string
     */
    public static function getFloatNum($num, $double = 8)
    {
        // 获取参数
        $num = (string)$num;
        $double = (int)$double;

        // 判断是否为科学计数法
        if (false !== stripos($num, "e")) {
            // 是科学计数法
            $a = explode("e", strtolower($num));
            return bcmul($a[0], bcpow(10, $a[1], $double), $double);
        } else {
            // 不是科学计数法
            $ary = explode('.', (string)$num);
            $float_patr = isset($ary[1]) ? $ary[1] : 0;
            $int_patr = isset($ary[0]) ? $ary[0] : 0;
            if (strlen($float_patr) > $double) {
                $decimal = substr($float_patr, 0, $double);
                $result = $int_patr . '.' . $decimal;
            } else {
                $result = number_format($num, $double, ".", "");
            }
            return (string)$result;
        }
    }

    // 获取一个多位数
    public static function get_str_num($id, $length)
    {
        $length = 0 - $length;
        return $data = substr(strval($id + 1000000000000), $length);
    }

    // db通过字符串分表
    public static function getTableNameByStr($v, $num = 1000, $strNum = 3)
    {
        $length = (strlen($v) > 19) ? 16 : (strlen($v) - 3);
        $v = substr($v, 3, $length);
        $modNum = crc32($v) % $num;
        return self::get_str_num($modNum, $strNum);
    }

    /**
     * [hideStar 用户名、邮箱、手机账号中间字符串以*隐藏]
     * @param  [string] $str [传过来字符串]
     * @return [string]      [返回带*字符串]
     */
    static function hide($str)
    {
        if ($str == "") {
            return "";
        }

        if (strpos($str, '@')) {
            $rs = substr_replace($str, '****', 1, strrpos($str, "@") - 3);
        } else {
            $mlen = strlen($str);

            if ($mlen > 5 && $mlen < 9)
                $rs = substr_replace($str, '***', 2, 3);
            elseif ($mlen >= 9)
                $rs = substr_replace($str, '****', 3, 4);
            else
                $rs = "*****";
        }

        return $rs;
    }
}