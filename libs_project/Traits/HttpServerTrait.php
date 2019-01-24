<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-5-27
 * Time: 上午10:10
 */
namespace Traits;

use Constant\Project;
use Project\TimerHandler;
use Response\Result;
use Tool\SyPack;
use Tool\Tool;

trait HttpServerTrait {
    /**
     * 接口签名缓存列表
     * @var \swoole_table
     */
    private static $_sySigns = null;
    /**
     * 最大签名缓存数量
     * @var int
     */
    private static $_sySignMaxNum = 0;
    /**
     * 当前签名缓存数量
     * @var int
     */
    private static $_sySignNowNum = 0;

    private function checkHttpServer(array $configs) {
        self::$_sySignNowNum = 0;
        self::$_sySignMaxNum = $configs['cachenum_sign'];
    }

    /**
     * 添加签名缓存
     * @param string $sign 签名信息
     * @return bool
     */
    public static function addApiSign(string $sign) : bool {
        $needSign = substr($sign, 16);
        if (self::$_sySigns->exist($needSign)) {
            return false;
        } else if (self::$_sySignNowNum < self::$_sySignMaxNum) {
            self::$_sySigns->set($needSign, [
                'sign' => $needSign,
                'time' => Tool::getNowTime(),
            ]);
            self::$_sySignNowNum++;

            return true;
        } else {
            return true;
        }
    }

    /**
     * 清理签名缓存
     */
    private function clearApiSign() {
        $time = Tool::getNowTime() - Project::TIME_EXPIRE_LOCAL_API_SIGN_CACHE;
        $delKeys = [];
        foreach (self::$_sySigns as $eSign) {
            if($eSign['time'] <= $time){
                $delKeys[] = $eSign['sign'];
            }
        }
        foreach ($delKeys as $eKey) {
            self::$_sySigns->del($eKey);
        }
        self::$_sySignNowNum = count(self::$_sySigns);
    }

    protected function initTableByHttpStart() {
        self::$_sySigns = new \swoole_table(self::$_sySignMaxNum);
        self::$_sySigns->column('sign', \swoole_table::TYPE_STRING, 32);
        self::$_sySigns->column('time', \swoole_table::TYPE_INT, 4);
        self::$_sySigns->create();
    }

    protected function handleHttpTask(array $data) {
        $resData = [
            'result' => 'success',
        ];
        $taskCommand = Tool::getArrayVal($data, 'task_command', '');
        switch ($taskCommand) {
            case Project::TASK_TYPE_CLEAR_API_SIGN_CACHE:
                $this->clearApiSign();
                break;
            case Project::TASK_TYPE_TIME_WHEEL_TASK:
                $nowTime = self::$_syServer->incr(self::$_serverToken, 'timer_time', 1);
                TimerHandler::handle($nowTime);
                break;
            default:
                $resData['result'] = 'fail';
                break;
        }

        $result = new Result();
        $result->setData($resData);
        return $result->getJson();
    }

    protected function addTimer(\swoole_server $server) {
        $this->_messagePack->setCommandAndData(SyPack::COMMAND_TYPE_SOCKET_CLIENT_SEND_TASK_REQ, [
            'task_module' => Project::MODULE_NAME_API,
            'task_command' => Project::TASK_TYPE_TIME_WHEEL_TASK,
            'task_params' => [],
        ]);
        $taskData = $this->_messagePack->packData();
        $this->_messagePack->init();

        $server->tick(1000, function() use ($server, $taskData) {
            $server->task($taskData);
        });
    }
}