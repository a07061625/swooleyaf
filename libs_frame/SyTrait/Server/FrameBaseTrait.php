<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/2/22 0022
 * Time: 16:52
 */
namespace SyTrait\Server;

use DesignPatterns\Singletons\RedisSingleton;
use Swoole\Table;
use SyTool\Tool;

trait FrameBaseTrait
{
    /**
     * 服务配置信息表
     *
     * @var \Swoole\Table
     */
    protected static $_syServer = null;
    /**
     * 注册的服务信息表
     *
     * @var \Swoole\Table
     */
    protected static $_syServices = null;
    /**
     * 健康检查列表
     *
     * @var \Swoole\Table
     */
    protected static $_syHealths = null;
    /**
     * 项目缓存列表
     *
     * @var \Swoole\Table
     */
    protected static $_syProject = null;
    /**
     * 项目微信缓存列表
     *
     * @var \Swoole\Table
     */
    protected static $_syWx = null;
    /**
     * 最大项目缓存数量
     *
     * @var int
     */
    private static $_syProjectMaxNum = 0;
    /**
     * 当前项目缓存数量
     *
     * @var int
     */
    private static $_syProjectNowNum = 0;
    /**
     * 最大微信缓存数量
     *
     * @var int
     */
    private static $_syWxMaxNum = 0;
    /**
     * 当前微信缓存数量
     *
     * @var int
     */
    private static $_syWxNowNum = 0;

    /**
     * 获取服务配置信息
     *
     * @param string $field   配置字段名称
     * @param null   $default
     *
     * @return mixed
     */
    public static function getServerConfig(string $field = null, $default = null)
    {
        if (is_null($field)) {
            $data = self::$_syServer->get(self::$_serverToken);

            return $data === false ? [] : $data;
        }
        $data = self::$_syServer->get(self::$_serverToken, $field);

        return $data === false ? $default : $data;
    }

    /**
     * 通过模块名称获取注册的服务信息
     *
     * @param string $moduleName
     *
     * @return array
     */
    public static function getServiceInfo(string $moduleName)
    {
        $serviceInfo = self::$_syServices->get($moduleName);

        return $serviceInfo === false ? [] : $serviceInfo;
    }

    /**
     * 设置项目缓存
     *
     * @param string $key  键名
     * @param array  $data 键值
     *
     * @return bool
     */
    public static function setProjectCache(string $key, array $data) : bool
    {
        if (strlen($key) == 0) {
            return false;
        } elseif (empty($data)) {
            return false;
        } elseif (self::$_syProject->exist($key)) {
            $data['tag'] = $key;
            self::$_syProject->set($key, $data);

            return true;
        } elseif (self::$_syProjectNowNum < self::$_syProjectMaxNum) {
            $data['tag'] = $key;
            self::$_syProject->set($key, $data);
            self::$_syProjectNowNum++;

            return true;
        }

        return false;
    }

    /**
     * 获取项目缓存
     *
     * @param string $key     键名
     * @param string $field   字段名
     * @param mixed  $default 默认值
     *
     * @return mixed
     */
    public static function getProjectCache(string $key, string $field = '', $default = null)
    {
        $data = self::$_syProject->get($key);
        if ($data === false) {
            return $default;
        } elseif ($field === '') {
            return $data;
        }

        return $data[$field] ?? $default;
    }

    /**
     * 删除项目缓存
     *
     * @param string $key
     *
     * @return mixed
     */
    public static function delProjectCache(string $key)
    {
        $delRes = self::$_syProject->del($key);
        if ($delRes) {
            self::$_syProjectNowNum--;
        }

        return $delRes;
    }

    /**
     * 设置项目微信缓存
     *
     * @param string $appTag 微信账号标识
     * @param array  $data   键值
     *
     * @return bool
     */
    public static function setWxCache(string $appTag, array $data) : bool
    {
        if (empty($data)) {
            return false;
        } elseif (self::$_syWx->exist($appTag)) {
            $data['app_tag'] = $appTag;
            self::$_syWx->set($appTag, $data);

            return true;
        } elseif (self::$_syWxNowNum < self::$_syWxMaxNum) {
            $data['app_tag'] = $appTag;
            self::$_syWx->set($appTag, $data);
            self::$_syWxNowNum++;

            return true;
        }

        return true;
    }

    /**
     * 获取项目微信缓存
     *
     * @param string $appTag  微信账号标识
     * @param string $field   字段名
     * @param mixed  $default 默认值
     *
     * @return mixed
     */
    public static function getWxCache(string $appTag, string $field = '', $default = null)
    {
        $data = self::$_syWx->get($appTag);
        if ($data === false) {
            return $default;
        } elseif ($field === '') {
            return $data;
        }

        return $data[$field] ?? $default;
    }

    /**
     * 删除项目微信缓存
     *
     * @param string $appTag
     *
     * @return mixed
     */
    public static function delWxCache(string $appTag)
    {
        $delRes = self::$_syWx->del($appTag);
        if ($delRes) {
            self::$_syWxNowNum--;
        }

        return $delRes;
    }

    /**
     * 清理项目微信缓存
     */
    public static function clearWxCache()
    {
        $nowTime = Tool::getNowTime();
        $delKeys = [];
        foreach (self::$_syWx as $eToken) {
            if ($eToken['clear_time'] < $nowTime) {
                $delKeys[] = $eToken['app_tag'];
            }
        }
        foreach ($delKeys as $eKey) {
            self::$_syWx->del($eKey);
        }
        self::$_syWxNowNum = self::$_syWx->count();
    }

    protected function checkServerBase()
    {
        $numHealthCheck = $this->_configs['server']['cachenum']['hc'];
        $numModules = $this->_configs['server']['cachenum']['modules'];
        if ($numHealthCheck < 1) {
            exit('健康检查缓存数量不能小于1');
        } elseif (($numHealthCheck & ($numHealthCheck - 1)) != 0) {
            exit('健康检查缓存数量必须是2的指数倍');
        }
        if ($numModules < 1) {
            exit('服务模块缓存数量不能小于1');
        } elseif (($numModules & ($numModules - 1)) != 0) {
            exit('服务模块缓存数量必须是2的指数倍');
        }

        self::$_syProjectNowNum = 0;
        self::$_syProjectMaxNum = $this->_configs['server']['cachenum']['local'];
        if (self::$_syProjectMaxNum < 1) {
            exit('项目缓存数量不能小于1');
        } elseif ((self::$_syProjectMaxNum & (self::$_syProjectMaxNum - 1)) != 0) {
            exit('项目缓存数量必须是2的指数倍');
        }

        self::$_syWxNowNum = 0;
        self::$_syWxMaxNum = $this->_configs['server']['cachenum']['wx'];
        if (self::$_syWxMaxNum < 1) {
            exit('微信缓存数量不能小于1');
        } elseif ((self::$_syWxMaxNum & (self::$_syWxMaxNum - 1)) != 0) {
            exit('微信缓存数量必须是2的指数倍');
        }

        //检测redis服务是否启动
        RedisSingleton::getInstance()->checkConn();

        $this->checkServerBaseTrait();
    }

    protected function initTableBase()
    {
        register_shutdown_function('\SyError\ErrorHandler::handleFatalError');

        self::$_syServer = new Table(1);
        self::$_syServer->column('memory_usage', Table::TYPE_INT, 4);
        self::$_syServer->column('timer_time', Table::TYPE_INT, 4);
        self::$_syServer->column('request_times', Table::TYPE_INT, 4);
        self::$_syServer->column('request_handling', Table::TYPE_INT, 4);
        self::$_syServer->column('host_local', Table::TYPE_STRING, 20);
        self::$_syServer->column('storepath_image', Table::TYPE_STRING, 150);
        self::$_syServer->column('storepath_music', Table::TYPE_STRING, 150);
        self::$_syServer->column('storepath_resources', Table::TYPE_STRING, 150);
        self::$_syServer->column('storepath_cache', Table::TYPE_STRING, 150);
        self::$_syServer->column('token_etime', Table::TYPE_INT, 8);
        self::$_syServer->column('unique_num', Table::TYPE_INT, 8);
        self::$_syServer->create();

        self::$_syHealths = new Table($this->_configs['server']['cachenum']['hc']);
        self::$_syHealths->column('tag', Table::TYPE_STRING, 60);
        self::$_syHealths->column('module', Table::TYPE_STRING, 30);
        self::$_syHealths->column('uri', Table::TYPE_STRING, 200);
        self::$_syHealths->create();

        self::$_syServices = new Table($this->_configs['server']['cachenum']['modules']);
        self::$_syServices->column('module', Table::TYPE_STRING, 30);
        self::$_syServices->column('host', Table::TYPE_STRING, 128);
        self::$_syServices->column('port', Table::TYPE_STRING, 5);
        self::$_syServices->column('type', Table::TYPE_STRING, 16);
        self::$_syServices->create();

        self::$_syProject = new Table($this->_configs['server']['cachenum']['local']);
        self::$_syProject->column('tag', Table::TYPE_STRING, 64);
        self::$_syProject->column('value', Table::TYPE_STRING, 200);
        self::$_syProject->column('expire_time', Table::TYPE_INT, 4);
        self::$_syProject->create();

        self::$_syWx = new Table($this->_configs['server']['cachenum']['wx']);
        self::$_syWx->column('app_tag', Table::TYPE_STRING, 24);
        self::$_syWx->column('at_content', Table::TYPE_STRING, 200);
        self::$_syWx->column('at_expire', Table::TYPE_INT, 4);
        self::$_syWx->column('jt_content', Table::TYPE_STRING, 200);
        self::$_syWx->column('jt_expire', Table::TYPE_INT, 4);
        self::$_syWx->column('ct_content', Table::TYPE_STRING, 200);
        self::$_syWx->column('ct_expire', Table::TYPE_INT, 4);
        self::$_syWx->column('clear_time', Table::TYPE_INT, 4);
        self::$_syWx->create();

        $this->initTableBaseTrait();
    }
}
