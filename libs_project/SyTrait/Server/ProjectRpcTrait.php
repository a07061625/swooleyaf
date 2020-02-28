<?php

/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-5-27
 * Time: 上午10:10
 */

namespace SyTrait\Server;

use Response\Result;
use Swoole\Server;

trait ProjectRpcTrait
{
    private function checkServerRpcTrait()
    {
    }

    private function initTableRpcTrait()
    {
    }

    private function addTaskRpcTrait(Server $server)
    {
    }

    /**
     * @param \Swoole\Server $server
     * @param int $taskId
     * @param int $fromId
     * @param array $data
     * @return string 空字符串:执行成功 非空:执行失败
     */
    private function handleTaskRpcTrait(Server $server, int $taskId, int $fromId, array &$data): string
    {
        return '';
    }

    private function handleReqExceptionByProject(\Throwable $e): Result
    {
    }
}
