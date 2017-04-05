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
