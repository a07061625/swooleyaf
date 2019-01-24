<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-6-22
 * Time: 上午12:09
 */
namespace SyFrame\Routes;

use Constant\ErrorCode;
use Exception\Validator\ValidatorException;
use SyFrame\BaseBootstarp;
use Yaf\Request_Abstract;
use Yaf\Route_Interface;

class BasicRoute extends Request_Abstract implements Route_Interface {
    /**
     * 允许的模块列表
     * @var array
     */
    private $acceptModules = [];
    /**
     * 默认模块名
     * @var string
     */
    private $defaultModule = '';
    /**
     * 默认控制器名
     * @var string
     */
    private $defaultController = '';
    /**
     * 默认动作名
     * @var string
     */
    private $defaultAction = '';

    public function __construct() {
        $this->acceptModules = BaseBootstarp::getAcceptModules();
        $this->defaultModule = BaseBootstarp::getDefaultModule();
        $this->defaultController = BaseBootstarp::getDefaultController();
        $this->defaultAction = BaseBootstarp::getDefaultAction();
    }

    private function __clone() {
    }

    /**
     * @param \Yaf\Request_Abstract $request
     * @return bool
     * @throws \Exception\Validator\ValidatorException
     */
    public function route($request) {
        $requestUri = preg_replace([
            '/[^0-9a-zA-Z\_\/]+/',
            '/\/{2,}/',
        ], [
            '',
            '/',
        ], urldecode($request->getRequestUri()));
        $trueUri = substr($requestUri, 0, 1) === '/' ? $requestUri : '/' . $requestUri;
        if (substr($requestUri, -1) !== '/') {
            $trueUri .= '/';
        }
        $uriArr = explode('/', $trueUri);
        $moduleName = $uriArr[1] !== '' ? ucfirst($uriArr[1]) : $this->defaultModule;
        if(!isset($this->acceptModules[$moduleName])){
            throw new ValidatorException('模块不支持', ErrorCode::COMMON_ROUTE_MODULE_NOT_ACCEPT);
        }

        if(isset($uriArr[2])){
            if (is_numeric(substr($uriArr[2], 0, 1))) {
                throw new ValidatorException('控制器名称不合法', ErrorCode::COMMON_ROUTE_CONTROLLER_NOT_EXIST);
            }

            $controllerName = ucfirst($uriArr[2]);
        } else {
            $controllerName = $this->defaultController;
        }
        if(isset($uriArr[3])){
            if (is_numeric(substr($uriArr[3], 0, 1))) {
                throw new ValidatorException('方法名称不合法', ErrorCode::COMMON_ROUTE_ACTION_NOT_EXIST);
            }

            $actionName = lcfirst($uriArr[3]);
        } else {
            $actionName = $this->defaultAction;
        }

        $request->setRequestUri('/' . $moduleName . '/' . $controllerName . '/' . $actionName);
        $request->setModuleName($moduleName);
        $request->setControllerName($controllerName);
        $request->setActionName($actionName);

        return true;
    }

    public function assemble(array $info, array $query = NULL) {
        return true;
    }
}