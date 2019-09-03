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

trait HttpServerTrait
{
    private function checkServerHttpTrait()
    {
    }

    private function initTableHttpTrait()
    {
    }

    private function addTaskHttpTrait(\swoole_server $server)
    {
    }

    private function getTokenExpireTime() : int
    {
        $expireTime = 0;
        $refreshUrl = (string)Tool::getConfig('project.' . SY_ENV . SY_PROJECT . '.token.url.refresh');
        if (ctype_digit(substr(SY_TOKEN, 0, 1))) {
            $expireTime = time() + 86400;
        } elseif (strlen($refreshUrl) > 0) {
            $sendRes = Tool::sendCurlReq([
                CURLOPT_URL => $refreshUrl . SY_TOKEN,
                CURLOPT_TIMEOUT_MS => 2000,
                CURLOPT_HEADER => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
            ]);
            if ($sendRes['res_no'] > 0) {
                return $expireTime;
            }
            $resData = Tool::jsonDecode($sendRes['res_content']);
            if (isset($resData['data']['expire_time']) && is_numeric($resData['data']['expire_time'])) {
                $expireTime = (int)$resData['data']['expire_time'];
            }
        }

        return $expireTime;
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
