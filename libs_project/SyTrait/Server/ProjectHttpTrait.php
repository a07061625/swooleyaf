<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-5-27
 * Time: 上午10:10
 */
namespace SyTrait\Server;

use SyConstant\Project;
use Project\TimerHandler;
use Response\Result;
use Tool\SyPack;
use Tool\Tool;

trait ProjectHttpTrait
{
    private function checkServerHttpTrait()
    {
    }

    private function initTableHttpTrait()
    {
    }

    private function addTaskHttpTrait(\swoole_server $server)
    {
        $this->_messagePack->setCommandAndData(SyPack::COMMAND_TYPE_SOCKET_CLIENT_SEND_TASK_REQ, [
            'task_module' => SY_MODULE,
            'task_command' => Project::TASK_TYPE_TIME_WHEEL_TASK,
            'task_params' => [],
        ]);
        $taskDataTimeWheel = $this->_messagePack->packData();
        $this->_messagePack->init();

        $server->tick(1000, function () use ($server, $taskDataTimeWheel) {
            $server->task($taskDataTimeWheel);
        });
    }

    private function getTokenExpireTime() : int
    {
        $decryptStr = Tool::decrypt(SY_TOKEN_SECRET, 'f68a600f6c1b1163');
        if (is_bool($decryptStr)) {
            return 0;
        } elseif (substr($decryptStr, 0, 8) != SY_TOKEN) {
            return 0;
        }

        return (int)substr($decryptStr, 8);
    }

    /**
     * @param \swoole_server $server
     * @param int $taskId
     * @param int $fromId
     * @param array $data
     * @return string 空字符串:执行成功 非空:执行失败
     */
    private function handleTaskHttpTrait(\swoole_server $server, int $taskId, int $fromId, array &$data) : string
    {
        $taskCommand = Tool::getArrayVal($data['params'], 'task_command', '');
        switch ($taskCommand) {
            case Project::TASK_TYPE_TIME_WHEEL_TASK:
                $nowTime = self::$_syServer->incr(self::$_serverToken, 'timer_time', 1);
                TimerHandler::handle($nowTime);
                break;
            case Project::TASK_TYPE_REFRESH_TOKEN_EXPIRE:
                self::$_syServer->set(self::$_serverToken, [
                    'token_etime' => $this->getTokenExpireTime(),
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

    private function handleReqExceptionByProject(\Exception $e) : Result
    {
    }
}
