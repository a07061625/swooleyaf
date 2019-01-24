<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/8/1 0001
 * Time: 11:30
 */
namespace Tool;

use Traits\SimpleTrait;

include_once __DIR__ . '/xhprof/xhprof_lib.php';
include_once __DIR__ . '/xhprof/xhprof_runs.php';

class SyXhprof {
    use SimpleTrait;

    /**
     * 开启性能分析
     */
    public static function start(){
        xhprof_enable(XHPROF_FLAGS_CPU|XHPROF_FLAGS_MEMORY, [
            'ignored_functions' => [
                'call_user_func',
                'call_user_func_array',
            ],
        ]);
    }

    /**
     * 执行性能分析
     * @param string $sourceTitle
     * @return array
     */
    public static function run(string $sourceTitle) : array {
        $title = strlen($sourceTitle) > 0 ? $sourceTitle : 'xhprof';
        $runs = new \XHProfRuns_Default();
        $runId = $runs->save_run(xhprof_disable(), $title);

        return [
            'run_id' => $runId,
            'source' => $title,
        ];
    }
}