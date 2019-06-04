<?php
declare(strict_types=1);


namespace Woisks\FilterWord;


/**
 * Class Helper
 *
 * @package Woisks\FilterWord
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/4 8:18
 */
class Helper
{

    /**
     * stringToArray 2019/6/4 8:18
     *
     * @param string $string
     *
     * @return array
     */
    public static function stringToArray(string $string): array
    {
        $chars = [];
        $length = mb_strlen($string);
        while ($length > 0) {
            $chars[] = mb_substr($string, 0, 1); //每次获取第一个字符
            $string = mb_substr($string, 1); //获取剩余的字符
            $length = mb_strlen($string); //获取长度做判断
        }

        return $chars;
    }
}