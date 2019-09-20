<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-5-27
 * Time: 上午10:09
 */
namespace SyTrait\Server;

use Swoole\Server;

trait ProjectBaseTrait
{
    private function checkServerBaseTrait()
    {
    }

    private function initTableBaseTrait()
    {
    }

    private function addTaskBaseTrait(Server $server)
    {
    }

    /**
     * @param \Swoole\Server $server
     * @param int $taskId
     * @param int $fromId
     * @param array $data
     * @return string 空字符串:执行成功 非空:执行失败
     */
    private function handleTaskBaseTrait(Server $server, int $taskId, int $fromId, array &$data) : string
    {
        return '';
    }
}
