<?php

namespace ApiBundle\Helper;


class StingForPattern
{
    private static $pattern = '/[^a-zA-z0-9]+/';

    public static function changeString($str)
    {
        return preg_replace(self::$pattern, '-', $str);
    }
}