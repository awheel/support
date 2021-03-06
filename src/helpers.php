<?php

use awheel\Support\Arr;

if (! function_exists('dd')) {
    /**
     * 打印数据, 并停止执行.
     */
    function dd()
    {
        echo '<pre>';
        array_map('var_dump', func_get_args());
        echo '</pre>';
        exit;
    }
}

if (! function_exists('value')) {
    /**
     * 返回给定值的默认值
     *
     * @param  mixed  $value
     * @return mixed
     * @link https://github.com/laravel/framework/blob/master/src/Illuminate/Support/helpers.php#L916
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (! function_exists('sizeFormat')) {
    /**
     * 大小格式化, 传入字位
     *
     * @param $bytes
     * @return string
     */
    function sizeFormat($bytes) {
        $s = ['B', 'Kb', 'MB', 'GB', 'TB', 'PB'];
        $e = floor(log($bytes)/log(1024));

        return sprintf('%.2f '.$s[$e], ($bytes/pow(1024, floor($e))));
    }
}

// https://github.com/illuminate/support/blob/master/helpers.php#L635
if (! function_exists('retry')) {
    /**
     * 自动重试指定次数
     *
     * @param  int  $times
     * @param  callable  $callback
     * @param  int  $sleep
     * @return mixed
     *
     * @throws \Exception
     */
    function retry($times, callable $callback, $sleep = 0)
    {
        $times--;

        beginning:
        try {
            return $callback();
        }
        catch (Exception $e) {
            if (! $times) {
                throw $e;
            }

            $times--;

            if ($sleep) {
                usleep($sleep * 1000);
            }

            goto beginning;
        }
    }
}

if (! function_exists('getZodiac')) {
    /**
     * 根据日期获取12生肖
     *
     * @param int|null $year
     *
     * @return bool|mixed
     */
    function getZodiac($year = null)
    {
        if ($year < 0 || $year > 9999) {
            return false;
        }

        $dict = array('猴', '鸡', '狗', '猪', '鼠', '牛', '虎', '兔', '龙', '蛇', '马', '羊');

        return $dict[$year % 12];
    }
}

if (! function_exists('array_column')) {
    /**
     * 返回数组中指定的一列
     *
     * @param array $array
     * @param string|array $column
     * @param string|int $index_key
     *
     * @return bool|mixed
     */
    function array_column(array $array, $column, $index_key = null)
    {
        return Arr::column($array, $column, $index_key);
    }
}

if (! function_exists('array_column_multi')) {
    /**
     * 返回数组中指定的一列或多列
     *
     * @param array $array
     * @param string|array $column
     * @param string|int $index_key
     *
     * @return bool|mixed
     */
    function array_column_multi(array $array, $column, $index_key = null)
    {
        $column = (array)$column;
        if (count($column) == 1) {
            return array_column($array, $column[0], $index_key);
        }

        $values = [];
        $i = 0;
        foreach ($array as $item) {
            $values[$index_key ? $item[$index_key] : $i] = Arr::only($item, $column);
            $i++;
        }

        return $values;
    }
}
