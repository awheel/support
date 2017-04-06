<?php

namespace awheel\Support;

/**
 * 字符串处理
 *
 * @package awheel\Support
 */
class Str
{
    /**
     * 生成一个更真实的“随机”字母数字字符串
     *
     * @param int $length
     *
     * @return string
     * @link https://github.com/illuminate/support/blob/master/Str.php#L234
     */
    static public function random($length = 16)
    {
        $string = '';

        while (($len = strlen($string)) < $length) {
            $size = $length - $len;
            $bytes = random_bytes($size);
            $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }

        return $string;
    }
}
