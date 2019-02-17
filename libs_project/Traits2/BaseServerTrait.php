<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-5-27
 * Time: 上午10:09
 */
namespace Traits2;

use Constant\ErrorCode;
use Constant\Project;
use DesignPatterns\Singletons\MysqlSingleton;
use DesignPatterns\Singletons\RedisSingleton;
use Response\Result;
use Tool\SyPack;
use Tool\Tool;

trait BaseServerTrait {
    private function checkServerBaseTrait() {
    }

    private function initTableBaseTrait() {
        self::$_syUsers = new \swoole_table($this->_configs['server']['cachenum']['users']);
        self::$_syUsers->column('session_id', \swoole_table::TYPE_STRING, 16);
        self::$_syUsers->column('user_id', \swoole_table::TYPE_STRING, 32);
        self::$_syUsers->column('user_name', \swoole_table::TYPE_STRING, 64);
        self::$_syUsers->column('user_headimage', \swoole_table::TYPE_STRING, 255);
        self::$_syUsers->column('user_openid', \swoole_table::TYPE_STRING, 32);
        self::$_syUsers->column('user_unid', \swoole_table::TYPE_STRING, 32);
        self::$_syUsers->column('user_phone', \swoole_table::TYPE_STRING, 11);
        self::$_syUsers->column('add_time', \swoole_table::TYPE_INT, 4);
        self::$_syUsers->create();
    }

    protected function handleBaseTask(\swoole_server $server,int $taskId,int $fromId,string $data) {
        $result = new Result();
        if(!$this->_syPack->unpackData($data)){
            $result->setCodeMsg(ErrorCode::COMMON_PARAM_ERROR, '数据格式不合法');
            return $result->getJson();
        }

        RedisSingleton::getInstance()->reConnect();
        if(SY_DATABASE){
            MysqlSingleton::getInstance()->reConnect();
        }

        $command = $this->_syPack->getCommand();
        $commandData = $this->_syPack->getData();
        $this->_syPack->init();

        if(in_array($command, [SyPack::COMMAND_TYPE_SOCKET_CLIENT_SEND_TASK_REQ, SyPack::COMMAND_TYPE_RPC_CLIENT_SEND_TASK_REQ])){
            $taskCommand = Tool::getArrayVal($commandData, 'task_command', '');
            switch ($taskCommand) {
                case Project::TASK_TYPE_CLEAR_LOCAL_USER_CACHE:
                    $this->clearLocalUsers();
                    break;
                case Project::TASK_TYPE_CLEAR_LOCAL_WX_CACHE:
                    $this->clearWxCache();
                    break;
                default:
                    return [
                        'command' => $command,
                        'params' => $commandData,
                    ];
            }

            $result->setData([
                'result' => 'success',
            ]);
        } else {
            $result->setData([
                'result' => 'fail',
            ]);
        }

        return $result->getJson();
    }
}