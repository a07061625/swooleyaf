<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-5-27
 * Time: 上午10:09
 */
namespace Traits;

trait BaseServerTrait {
    private function checkServerBaseTrait() {
    }

    private function initTableBaseTrait() {
    }

    private function addTaskBaseTrait(\swoole_server $server) {
    }

    /**
     * @param \swoole_server $server
     * @param int $taskId
     * @param int $fromId
     * @param array $data
     * @return string 空字符串:执行成功 非空:执行失败
     */
    private function handleTaskBaseTrait(\swoole_server $server,int $taskId,int $fromId,array &$data) : string {
        return '';
    }
}