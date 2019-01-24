<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-5-27
 * Time: 上午10:09
 */
namespace Traits;

use Constant\ErrorCode;
use Constant\Project;
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
     * 用户信息列表
     * @var \swoole_table
     */
    protected static $_syUsers = null;
    /**
     * 项目微信缓存列表
     * @var \swoole_table
     */
    protected static $_syWx = null;
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
    /**
     * 最大用户数量
     * @var int
     */
    private static $_syUserMaxNum = 0;
    /**
     * 当前用户数量
     * @var int
     */
    private static $_syUserNowNum = 0;
    /**
     * 最大微信缓存数量
     * @var int
     */
    private static $_syWxMaxNum = 0;
    /**
     * 当前微信缓存数量
     * @var int
     */
    private static $_syWxNowNum = 0;

    private function checkBaseServer() {
        self::$_syProjectNowNum = 0;
        self::$_syProjectMaxNum = (int)$this->_configs['server']['cachenum']['local'];
        if (self::$_syProjectMaxNum < 2) {
            exit('项目缓存数量不能小于2');
        } else if ((self::$_syProjectMaxNum & (self::$_syProjectMaxNum - 1)) != 0) {
            exit('项目缓存数量必须是2的指数倍');
        }

        self::$_syUserNowNum = 0;
        self::$_syUserMaxNum = (int)$this->_configs['server']['cachenum']['users'];
        if (self::$_syUserMaxNum < 2) {
            exit('用户信息缓存数量不能小于2');
        } else if ((self::$_syUserMaxNum & (self::$_syUserMaxNum - 1)) != 0) {
            exit('用户信息缓存数量必须是2的指数倍');
        }

        self::$_syWxNowNum = 0;
        self::$_syWxMaxNum = (int)$this->_configs['server']['cachenum']['wx'];
        if (self::$_syWxMaxNum < 2) {
            exit('微信缓存数量不能小于2');
        } else if ((self::$_syWxMaxNum & (self::$_syWxMaxNum - 1)) != 0) {
            exit('微信缓存数量必须是2的指数倍');
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

    /**
     * 添加本地用户信息
     * @param string $sessionId 会话ID
     * @param array $userData
     * @return bool
     */
    public static function addLocalUserInfo(string $sessionId,array $userData) : bool {
        if (self::$_syUsers->exist($sessionId)) {
            $userData['session_id'] = $sessionId;
            $userData['add_time'] = Tool::getNowTime();
            self::$_syUsers->set($sessionId, $userData);
            return true;
        } else if (self::$_syUserNowNum < self::$_syUserMaxNum) {
            $userData['session_id'] = $sessionId;
            $userData['add_time'] = Tool::getNowTime();
            self::$_syUsers->set($sessionId, $userData);
            self::$_syUserNowNum++;
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获取本地用户信息
     * @param string $sessionId 会话ID
     * @return array
     */
    public static function getLocalUserInfo(string $sessionId){
        $data = self::$_syUsers->get($sessionId);
        return $data === false ? [] : $data;
    }

    /**
     * 删除本地用户信息
     * @param string $sessionId 会话ID
     * @return bool
     */
    public static function delLocalUserInfo(string $sessionId) {
        $delRes = self::$_syUsers->del($sessionId);
        if($delRes){
            self::$_syUserNowNum--;
        }
        return $delRes;
    }

    /**
     * 清理本地用户信息缓存
     */
    protected function clearLocalUsers() {
        $time = Tool::getNowTime() - Project::TIME_EXPIRE_LOCAL_USER_CACHE;
        $delKeys = [];
        foreach (self::$_syUsers as $eUser) {
            if($eUser['add_time'] <= $time){
                $delKeys[] = $eUser['session_id'];
            }
        }
        foreach ($delKeys as $eKey) {
            self::$_syUsers->del($eKey);
        }
        self::$_syUserNowNum = count(self::$_syUsers);
    }

    /**
     * 设置项目微信缓存
     * @param string $appTag 微信账号标识
     * @param array $data 键值
     * @return bool
     */
    public static function setWxCache(string $appTag,array $data) : bool {
        if(empty($data)){
            return false;
        } else if(self::$_syWx->exist($appTag)){
            $data['app_tag'] = $appTag;
            self::$_syWx->set($appTag, $data);
            return true;
        } else if(self::$_syWxNowNum < self::$_syWxMaxNum){
            $data['app_tag'] = $appTag;
            self::$_syWx->set($appTag, $data);
            self::$_syWxNowNum++;
            return true;
        } else {
            return true;
        }
    }

    /**
     * 获取项目微信缓存
     * @param string $appTag 微信账号标识
     * @param string $field 字段名
     * @param mixed $default 默认值
     * @return mixed
     */
    public static function getWxCache(string $appTag,string $field='', $default=null){
        $data = self::$_syWx->get($appTag);
        if($data === false){
            return $default;
        } else if($field === ''){
            return $data;
        } else {
            return $data[$field] ?? $default;
        }
    }

    /**
     * 删除项目微信缓存
     * @param string $appTag
     * @return mixed
     */
    public static function delWxCache(string $appTag) {
        $delRes = self::$_syWx->del($appTag);
        if($delRes){
            self::$_syWxNowNum--;
        }
        return $delRes;
    }

    /**
     * 清理项目微信缓存
     */
    protected function clearWxCache() {
        $nowTime = Tool::getNowTime();
        $delKeys = [];
        foreach (self::$_syWx as $eToken) {
            if($eToken['clear_time'] < $nowTime){
                $delKeys[] = $eToken['app_tag'];
            }
        }
        foreach ($delKeys as $eKey) {
            self::$_syWx->del($eKey);
        }
        self::$_syWxNowNum = count(self::$_syWx);
    }

    protected function initTableByBaseStart() {
        self::$_syProject = new \swoole_table((int)$this->_configs['server']['cachenum']['local']);
        self::$_syProject->column('tag', \swoole_table::TYPE_STRING, 64);
        self::$_syProject->column('value', \swoole_table::TYPE_STRING, 200);
        self::$_syProject->column('expire_time', \swoole_table::TYPE_INT, 4);
        self::$_syProject->create();

        self::$_syUsers = new \swoole_table((int)$this->_configs['server']['cachenum']['users']);
        self::$_syUsers->column('session_id', \swoole_table::TYPE_STRING, 16);
        self::$_syUsers->column('user_id', \swoole_table::TYPE_STRING, 32);
        self::$_syUsers->column('user_name', \swoole_table::TYPE_STRING, 64);
        self::$_syUsers->column('user_headimage', \swoole_table::TYPE_STRING, 255);
        self::$_syUsers->column('user_openid', \swoole_table::TYPE_STRING, 32);
        self::$_syUsers->column('user_unid', \swoole_table::TYPE_STRING, 32);
        self::$_syUsers->column('user_phone', \swoole_table::TYPE_STRING, 11);
        self::$_syUsers->column('add_time', \swoole_table::TYPE_INT, 4);
        self::$_syUsers->create();

        self::$_syWx = new \swoole_table((int)$this->_configs['server']['cachenum']['wx']);
        self::$_syWx->column('app_tag', \swoole_table::TYPE_STRING, 24);
        self::$_syWx->column('at_content', \swoole_table::TYPE_STRING, 200);
        self::$_syWx->column('at_expire', \swoole_table::TYPE_INT, 4);
        self::$_syWx->column('jt_content', \swoole_table::TYPE_STRING, 200);
        self::$_syWx->column('jt_expire', \swoole_table::TYPE_INT, 4);
        self::$_syWx->column('clear_time', \swoole_table::TYPE_INT, 4);
        self::$_syWx->create();
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