<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-5-27
 * Time: 上午10:10
 */
namespace SyTrait\Server;

use DesignPatterns\Factories\CacheSimpleFactory;
use ProjectTask\DataFeed\GoodsTreatComplete;
use ProjectTask\DataFeed\GoodsTreatStart;
use ProjectTask\Mail\PlanPreTreatComplete;
use ProjectTask\Mail\PlanPreTreatStart;
use ProjectTask\Mail\PlanTreatComplete;
use ProjectTask\Mail\PlanTreatStart;
use ProjectTask\Mail\TplTreatComplete;
use ProjectTask\Mail\TplTreatStart;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Server;
use SyConstant\Project;
use SyLog\Log;
use SyResponse\Result;
use SyTool\SyPack;
use SyTool\Tool;

trait ProjectHttpTrait2
{
    private function checkServerHttpTrait()
    {
        ini_set('session.save_handler', 'redis');
        ini_set('session.save_path', 'tcp://127.0.0.1:6379');
        ini_set('session.cookie_domain', SY_COOKIE_DOMAIN);
    }

    private function initTableHttpTrait()
    {
    }

    private function addTaskHttpTrait(Server $server)
    {
        $this->_messagePack->setCommandAndData(SyPack::COMMAND_TYPE_SOCKET_CLIENT_SEND_TASK_REQ, [
            'task_module' => SY_MODULE,
            'task_command' => Project::TASK_TYPE_MAIL_PLAN,
            'task_params' => [],
        ]);
        $taskData1 = $this->_messagePack->packData();
        $this->_messagePack->init();
        $server->tick(Project::TIME_TASK_MAIL_PLAN, function () use ($server, $taskData1) {
            $server->task($taskData1);
        });

        $this->_messagePack->setCommandAndData(SyPack::COMMAND_TYPE_SOCKET_CLIENT_SEND_TASK_REQ, [
            'task_module' => SY_MODULE,
            'task_command' => Project::TASK_TYPE_DATA_FEED,
            'task_params' => [],
        ]);
        $taskData2 = $this->_messagePack->packData();
        $this->_messagePack->init();
        $server->tick(Project::TIME_TASK_DATA_FEED, function () use ($server, $taskData2) {
            $server->task($taskData2);
        });

        $this->_messagePack->setCommandAndData(SyPack::COMMAND_TYPE_SOCKET_CLIENT_SEND_TASK_REQ, [
            'task_module' => SY_MODULE,
            'task_command' => Project::TASK_TYPE_MAIL_TPL_TASK,
            'task_params' => [],
        ]);
        $taskData3 = $this->_messagePack->packData();
        $this->_messagePack->init();
        $server->tick(Project::TIME_TASK_MAIL_TPL_TASK, function () use ($server, $taskData3) {
            $server->task($taskData3);
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
     * @param \Swoole\Server $server
     * @param int $taskId
     * @param int $fromId
     * @param array $data
     * @return string 空字符串:执行成功 非空:执行失败
     */
    private function handleTaskHttpTrait(Server $server, int $taskId, int $fromId, array &$data) : string
    {
        $taskCommand = Tool::getArrayVal($data['params'], 'task_command', '');
        switch ($taskCommand) {
            case Project::TASK_TYPE_REFRESH_TOKEN_EXPIRE:
                self::$_syServer->set(self::$_serverToken, [
                    'token_etime' => $this->getTokenExpireTime(),
                ]);
                break;
            case Project::TASK_TYPE_MAIL_PLAN:
                $redisKey = Project::REDIS_PREFIX_TASK_MAIL . '1';
                $cacheData = CacheSimpleFactory::getRedisInstance()->get($redisKey);
                if (is_bool($cacheData)) {
                    CacheSimpleFactory::getRedisInstance()->set($redisKey, '1', 360);

                    try {
                        PlanPreTreatStart::handleTask($data['params']['task_params']);
                    } catch (\Exception $e) {
                        Log::error($e->getMessage());
                    }

                    try {
                        PlanPreTreatComplete::handleTask($data['params']['task_params']);
                    } catch (\Exception $e) {
                        Log::error($e->getMessage());
                    }

                    try {
                        PlanTreatStart::handleTask($data['params']['task_params']);
                    } catch (\Exception $e) {
                        Log::error($e->getMessage());
                    }
                    try {
                        PlanTreatComplete::handleTask($data['params']['task_params']);
                    } catch (\Exception $e) {
                        Log::error($e->getMessage());
                    }

                    CacheSimpleFactory::getRedisInstance()->del($redisKey);
                }
                break;
            case Project::TASK_TYPE_DATA_FEED:
                $redisKey = Project::REDIS_PREFIX_TASK_DATA_FEED . '1';
                $cacheData = CacheSimpleFactory::getRedisInstance()->get($redisKey);
                if (is_bool($cacheData)) {
                    CacheSimpleFactory::getRedisInstance()->set($redisKey, '1', 360);

                    try {
                        GoodsTreatStart::handleTask($data['params']['task_params']);
                    } catch (\Exception $e) {
                        Log::error($e->getMessage());
                    }
                    try {
                        GoodsTreatComplete::handleTask($data['params']['task_params']);
                    } catch (\Exception $e) {
                        Log::error($e->getMessage());
                    }

                    CacheSimpleFactory::getRedisInstance()->del($redisKey);
                }
                break;
            case Project::TASK_TYPE_MAIL_TPL_TASK:
                $redisKey = Project::REDIS_PREFIX_TASK_MAIL_TPL_TASK . '1';
                $cacheData = CacheSimpleFactory::getRedisInstance()->get($redisKey);
                if (is_bool($cacheData)) {
                    CacheSimpleFactory::getRedisInstance()->set($redisKey, '1', 360);

                    try {
                        TplTreatStart::handleTask($data['params']['task_params']);
                    } catch (\Exception $e) {
                        Log::error($e->getMessage());
                    }
                    try {
                        TplTreatComplete::handleTask($data['params']['task_params']);
                    } catch (\Exception $e) {
                        Log::error($e->getMessage());
                    }

                    CacheSimpleFactory::getRedisInstance()->del($redisKey);
                }
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

    private function initYiiReq(Request $request, Response $response)
    {
        $this->_app->request->setSwRequest($request);
        $this->_app->response->setSwResponse($response);
        $this->_app->request->getHeaders()->removeAll();
        $this->_app->response->clear();
        foreach ($request->header as $name => $value) {
            $this->_app->request->getHeaders()->set($name, $value);
        }
        $this->_app->request->setQueryParams($_GET);
        $this->_app->request->setBodyParams($_POST);
        $rawContent = $request->rawContent() ?? null;
        $this->_app->request->setRawBody($rawContent);
        $this->_app->request->setPathInfo($request->server['path_info']);
    }
}
