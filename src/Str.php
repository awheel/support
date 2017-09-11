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
     * @link https://github.com/illuminate/support/blob/master/Str.php#L234
     *
     * @return string
     * @throws \Exception
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

    /**
     * Extended ASCII 特殊英文字幕, 希腊字母, 拉丁字母替换为标准字母
     *
     * @link https://zh.wikipedia.org/wiki/EASCII
     * @link https://en.wikipedia.org/wiki/List_of_Latin-script_alphabets
     *
     * @param string $string
     * @return string
     */
    static public function eAsciiReplace($string)
    {
        $map = [
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ǎ' => 'A',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'ǎ' => 'a',
            'B̌' => 'B',
            'þ' => 'b', 'b̌' => 'b',
            'Ç' => 'C', 'Č' => 'C', 'Ć' => 'C', 'Ḉ' => 'C',
            'ç' => 'c', 'č' => 'c', 'ć' => 'c', 'ḉ' => 'c',
            'Ð' => 'D', 'Ď' => 'D',
            'ď' => 'd', 'ð' => 'd',
            'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ě' => 'E',
            'ě' => 'e', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e',
            'F̌' => 'F',
            'f̌' => 'f',
            'Ǧ' => 'G', 'ǧ' => 'g',
            'Ȟ' => 'H', 'ȟ' => 'h',
            'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ǐ' => 'I',
            'ǐ' => 'i', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
            'J̌' => 'J',
            'ǰ' => 'j',
            'Ǩ' => 'K',
            'ǩ' => 'k',
            'Ľ' => 'L',
            'ľ' => 'l',
            'Ň' => 'N', 'Ñ' => 'N',
            'ň' => 'n', 'ñ' => 'n',
            'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ǒ' => 'O',
            'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ǒ' => 'o',
            'Þ' => 'p',
            'Ř' => 'R', 'ř' => 'r', 'Ř̩' => 'R', 'ř̩' => 'r',
            'Š' => 'S', 'Ṧ' => 'S',
            'š' => 's', 'ß' => 's',  'ṧ' => 's',
            'Ť' => 'T', 'ť' => 't',
            'Ǔ' => 'U', 'Ǚ' => 'U', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U',
            'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ǚ' => 'u', 'ǔ' => 'u',
            'X̌' => 'X',
            'x̌' => 'x', '×' => 'x',
            'Ý' => 'Y',
            'ý' => 'y', 'ÿ' => 'y',
            'Ž' => 'Z', 'ž' => 'z', 'Ǯ' => 'Z', 'ǯ' => 'Z',
        ];

        return strtr($string, $map);
    }
}
