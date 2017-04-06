<?php

namespace awheel\Support;

/**
 * 日期处理, 复杂场景请直接使用: https://github.com/briannesbitt/Carbon
 *
 * @package awheel\Support
 */
class Date
{
    /**
     * 计算日期的星期
     *
     * @param $date
     *
     * @return string
     */
    static public function getWeekday($date)
    {
        $map = array('日','一','二','三','四','五','六');

        return "星期" . $map[date('w', is_numeric($date) && strlen($date) == 10 ? $date : strtotime($date))];
    }
}
