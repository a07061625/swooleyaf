<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-5-27
 * Time: 上午10:10
 */
namespace Traits;

use Constant\Project;
use Response\Result;
use Tool\Tool;

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
        $taskCommand = Tool::getArrayVal($data['params'], 'task_command', '');
        switch ($taskCommand) {
            case Project::TASK_TYPE_REFRESH_TOKEN_EXPIRE:
                self::$_syServer->set(self::$_serverToken, [
                    'token_etime' => 16000000000,
                ]);
                break;
            default:
                $result = new Result();
                $result->setData([
                    'result' => 'fail',
                ]);
                return $result->getJson();
        }

        return '';
    }
}