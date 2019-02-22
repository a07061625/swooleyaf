<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/2/22 0022
 * Time: 9:13
 */
namespace SyFrame;

use Constant\ErrorCode;
use Constant\Server;
use Exception\Swoole\ServerException;
use SyFrame\Plugins\ActionLogPlugin;
use SyFrame\Plugins\CheckConnectPlugin;
use SyFrame\Plugins\FinishServicePlugin;
use SyFrame\Plugins\MethodExistPlugin;
use SyFrame\Plugins\ValidatorPlugin;
use SyFrame\Routes\SimpleRoute;
use Tool\Tool;
use Yaf\Application;
use Yaf\Bootstrap_Abstract;
use Yaf\Dispatcher;
use Yaf\Registry;

abstract class SimpleBootstrap extends Bootstrap_Abstract {
    /**
     * 首次请求标识,true:首次请求 false:非首次请求
     * @var bool
     */
    protected static $firstTag = true;
    /**
     * APP配置数组
     * @var array
     */
    private static $appConfigs = [];
    /**
     * 允许的模块列表
     * @var array
     */
    private static $acceptModules = [];

    /**
     * 通用初始化
     * @param \Yaf\Dispatcher $dispatcher
     * @throws \Exception\Swoole\ServerException
     */
    protected function universalInit(Dispatcher $dispatcher) {
        //设置应用配置
        $config = Application::app()->getConfig();
        self::$appConfigs = $config->toArray();
        if(empty(self::$appConfigs)){
            throw new ServerException('APP配置不能为空', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        }
        if (isset(self::$appConfigs['application']['modules'])) {
            $moduleArr = explode(',', self::$appConfigs['application']['modules']);
            foreach ($moduleArr as $eModule) {
                $eModuleTag = trim($eModule);
                if(ctype_alnum($eModuleTag) && ctype_alpha($eModuleTag{0})){
                    self::$acceptModules[$eModuleTag] = 1;
                }
            }
        }
        if (empty(self::$acceptModules)) {
            throw new ServerException('允许的模块列表不能为空', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        }

        Registry::set('config', $config);

        //设置默认模块
        $defaultModule = isset(self::$appConfigs['application']['dispatcher']['defaultModule']) ? self::$appConfigs['application']['dispatcher']['defaultModule'] : '';
        if (strlen($defaultModule) == 0) {
            throw new ServerException('默认模块名不存在', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        } else if(!ctype_alnum($defaultModule)){
            throw new ServerException('默认模块名不合法', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        } else if(!ctype_alpha($defaultModule{0})){
            throw new ServerException('默认模块名不合法', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        }
        define('SY_DEFAULT_MODULE', ucfirst($defaultModule));

        //设置默认控制器
        $defaultController = isset(self::$appConfigs['application']['dispatcher']['defaultController']) ? self::$appConfigs['application']['dispatcher']['defaultController'] : '';
        if (strlen($defaultController) == 0) {
            throw new ServerException('默认控制器名不存在', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        } else if(!ctype_alnum($defaultController)){
            throw new ServerException('默认控制器名不合法', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        } else if(!ctype_alpha($defaultController{0})){
            throw new ServerException('默认控制器名不合法', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        }
        define('SY_DEFAULT_CONTROLLER', ucfirst($defaultController));

        //设置默认方法
        $defaultAction = isset(self::$appConfigs['application']['dispatcher']['defaultAction']) ? self::$appConfigs['application']['dispatcher']['defaultAction'] : '';
        if (strlen($defaultAction) == 0) {
            throw new ServerException('默认方法名不存在', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        } else if(!ctype_alnum($defaultAction)){
            throw new ServerException('默认方法名不合法', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        } else if(!ctype_alpha($defaultAction{0})){
            throw new ServerException('默认方法名不合法', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        }
        define('SY_DEFAULT_ACTION', lcfirst($defaultAction));

        $dispatcher->setDefaultModule(SY_DEFAULT_MODULE)
                   ->setDefaultController(SY_DEFAULT_CONTROLLER)
                   ->setDefaultAction(SY_DEFAULT_ACTION)
                   ->registerPlugin(new MethodExistPlugin())
                   ->registerPlugin(new CheckConnectPlugin())
                   ->registerPlugin(new ValidatorPlugin())
                   ->registerPlugin(new FinishServicePlugin())
                   ->registerPlugin(new ActionLogPlugin());
        $dispatcher->getRouter()->addRoute(Server::ROUTE_TYPE_SIMPLE, new SimpleRoute());
    }

    /**
     * 获取APP配置
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     */
    public static function getAppConfigs(string $key=null, $default=null) {
        if ($key === null) {
            return self::$appConfigs;
        } else {
            return Tool::getArrayVal(self::$appConfigs, $key, $default, true);
        }
    }

    /**
     * @return array
     */
    public static function getAcceptModules() : array {
        return self::$acceptModules;
    }
}