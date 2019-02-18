<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-5-27
 * Time: 上午10:10
 */
namespace Traits2;

trait HttpServerTrait {
    private function checkServerHttpTrait() {
    }

    private function initTableHttpTrait() {
    }

    private function addTaskHttpTrait(\swoole_server $server) {
    }

    /**
     * @param \swoole_server $server
     * @param int $taskId
     * @param int $fromId
     * @param array $data
     * @return string 空字符串:执行成功 非空:执行失败
     */
    private function handleTaskHttpTrait(\swoole_server $server,int $taskId,int $fromId,array &$data) : string {
        return '';
    }
}