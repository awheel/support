<?php

namespace awheel\Support;

/**
 * 数组处理函数
 *
 * @package awheel\Support
 */
class Arr
{
    /**
     * 使用 key 从一个数组获取一条数据, 并删除这条数据
     *
     * @param $array
     * @param $key
     * @param null $default
     *
     * @return null
     */
    static public function pull(&$array, $key, $default = null)
    {
        $value = isset($array[$key]) ? $array[$key] : $default;

        unset($array[$key]);

        return $value;
    }

    /**
     * array_column 实现, php 5.6
     *
     * @param $array
     * @param $column_key
     * @param null $index_key
     *
     * @return array
     */
    static public function column($array, $column_key, $index_key = null)
    {
        if (version_compare(PHP_VERSION, '5.6.0', '>=')) {
            return array_column($array, $column_key, $index_key);
        }

        if ($index_key !== null) {
            $keys = [];
            $i = 0;
            foreach ($array as $row) {
                if (array_key_exists($index_key, $row)) {
                    if (is_numeric($row[$index_key]) || is_bool($row[$index_key])) {
                        $i = max($i, (int)$row[$index_key] + 1);
                    }

                    $keys[] = $row[$index_key];
                }
                else {
                    $keys[] = $i++;
                }
            }
        }

        if ($column_key !== null) {
            $values = [];
            $i = 0;
            foreach ($array as $row) {
                if (array_key_exists($column_key, $row)) {
                    $values[] = $row[$column_key];
                    $i++;
                }
                elseif (isset($keys)) {
                    array_splice($keys, $i, 1);
                }
            }
        }
        else {
            $values = array_values($array);
        }

        if ($index_key !== null) {
            return array_combine($keys, $values);
        }

        return $values;
    }

    /**
     * 根据第二维某个字段分组
     *
     * @param $array
     * @param $field
     * @param null $callback
     *
     * @return array
     */
    static public function group($array, $field, $callback = null)
    {
        $group = [];

        foreach ($array as $k => $v) {
            if ($callback === null || !is_callable($callback)) {
                $group[$v[$field]][] = $v;
            }
            else {
                $newField = $callback($v[$field]);
                $group[$newField][] = $v;
            }
        }

        return $group;
    }

    /**
     * 从数组种获取指定 key 的数据，和 Arr::except 相反
     *
     * @param  array  $array
     * @param  array|string  $keys
     * @return array
     */
    static public function only($array, $keys)
    {
        return array_intersect_key($array, array_flip((array) $keys));
    }

    /**
     * 从数组种获取指定 key 以外的全部数据，和 Arr::only 相反
     *
     * @param $array
     * @param $keys
     *
     * @return array
     */
    static public function except($array, $keys) {
        return array_diff_key($array, array_flip((array) $keys));
    }

    /**
     * 使用二维数组下指定字段作为 key 组成新的数组
     *
     * @param $array
     * @param $key
     *
     * @return array
     */
    static public function newKey($array, $key)
    {
        if (!$array || !$key) {
            return $array;
        }

        $newArray = [];
        foreach ($array as $k => $v) {
            if (!isset($v[$key])) {
                return $array;
            }

            $newArray[$v[$key]] = $v;
        }

        return $newArray;
    }
}
