<?php

if (!function_exists('dr_debug')) {
    function dr_debug($file, $data) {
        dr_mkdirs(WRITEPATH.'debuglog/');
        $debug = debug_backtrace();
        file_put_contents(WRITEPATH.'debuglog/'.dr_safe_filename($file).'.txt', var_export([
                '时间' => dr_date(SYS_TIME, 'Y-m-d H:i:s'),
                '终端' => (string)$_SERVER['HTTP_USER_AGENT'],
                '文件' => $debug[0]['file'],
                '行号' => $debug[0]['line'],
                '地址' => FC_NOW_URL,
                '变量' => $data,
            ], true).PHP_EOL.'=========================================================='.PHP_EOL, FILE_APPEND);
    }
}