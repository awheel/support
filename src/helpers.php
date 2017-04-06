<?php

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
