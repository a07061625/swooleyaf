<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-5-27
 * Time: 上午10:09
 */
namespace Traits;

use Constant\ErrorCode;
use DesignPatterns\Singletons\MysqlSingleton;
use DesignPatterns\Singletons\RedisSingleton;
use Response\Result;
use Tool\SyPack;
use Tool\Tool;

trait BaseServerTrait {
    /**
     * 配置数组
     * @var array
     */
    protected $_configs = [];
    /**
     * @var \Tool\SyPack
     */
    protected $_syPack = null;
    /**
     * 项目缓存列表
     * @var \swoole_table
     */
    protected static $_syProject = null;
    /**
     * 最大项目缓存数量
     * @var int
     */
    private static $_syProjectMaxNum = 0;
    /**
     * 当前项目缓存数量
     * @var int
     */
    private static $_syProjectNowNum = 0;

    private function checkBaseServer() {
        self::$_syProjectNowNum = 0;
        self::$_syProjectMaxNum = (int)$this->_configs['server']['cachenum']['local'];
        if (self::$_syProjectMaxNum < 2) {
            exit('项目缓存数量不能小于2');
        } else if ((self::$_syProjectMaxNum & (self::$_syProjectMaxNum - 1)) != 0) {
            exit('项目缓存数量必须是2的指数倍');
        }

        //检测redis服务是否启动
        RedisSingleton::getInstance()->checkConn();

        $this->_syPack = new SyPack();
    }

    /**
     * 设置项目缓存
     * @param string $key 键名
     * @param array $data 键值
     * @return bool
     */
    public static function setProjectCache(string $key,array $data) : bool {
        if(strlen($key) == 0){
            return false;
        } else if (empty($data)) {
            return false;
        } else if(self::$_syProject->exist($key)){
            $data['tag'] = $key;
            self::$_syProject->set($key, $data);
            return true;
        } else if(self::$_syProjectNowNum < self::$_syProjectMaxNum){
            $data['tag'] = $key;
            self::$_syProject->set($key, $data);
            self::$_syProjectNowNum++;
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获取项目缓存
     * @param string $key 键名
     * @param string $field 字段名
     * @param mixed $default 默认值
     * @return mixed
     */
    public static function getProjectCache(string $key,string $field='', $default=null){
        $data = self::$_syProject->get($key);
        if($data === false){
            return $default;
        } else if($field === ''){
            return $data;
        } else {
            return $data[$field] ?? $default;
        }
    }

    /**
     * 删除项目缓存
     * @param string $key
     * @return mixed
     */
    public static function delProjectCache(string $key) {
        $delRes = self::$_syProject->del($key);
        if ($delRes) {
            self::$_syProjectNowNum--;
        }
        return $delRes;
    }

    protected function initTableByBaseStart() {
        self::$_syProject = new \swoole_table((int)$this->_configs['server']['cachenum']['local']);
        self::$_syProject->column('tag', \swoole_table::TYPE_STRING, 64);
        self::$_syProject->column('value', \swoole_table::TYPE_STRING, 200);
        self::$_syProject->column('expire_time', \swoole_table::TYPE_INT, 4);
        self::$_syProject->create();
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