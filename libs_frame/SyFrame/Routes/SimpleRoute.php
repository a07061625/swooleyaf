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
use SyFrame\SimpleBootstrap;
use Yaf\Request_Abstract;
use Yaf\Route_Interface;

class SimpleRoute extends Request_Abstract implements Route_Interface {
    /**
     * 允许的模块列表
     * @var array
     */
    private $acceptModules = [];

    public function __construct() {
        $this->acceptModules = SimpleBootstrap::getAcceptModules();
    }

    private function __clone() {
    }

    /**
     * @param \Yaf\Request_Abstract $request
     * @return bool
     * @throws \Exception\Validator\ValidatorException
     */
    public function route($request) {
        $uriArr = explode('/', $request->getRequestUri());
        $moduleName = strlen($uriArr[1]) > 0 ? ucfirst($uriArr[1]) : SY_DEFAULT_MODULE;
        if(!isset($this->acceptModules[$moduleName])){
            throw new ValidatorException('模块不支持', ErrorCode::COMMON_ROUTE_MODULE_NOT_ACCEPT);
        }

        $controllerName = isset($uriArr[2]) ? ucfirst($uriArr[2]) : SY_DEFAULT_CONTROLLER;
        $actionName = isset($uriArr[3]) ? lcfirst($uriArr[3]) : SY_DEFAULT_ACTION;

        $requestUri = '/' . $moduleName . '/' . $controllerName . '/' . $actionName;
        if (isset($uriArr[4])) {
            unset($uriArr[0], $uriArr[1], $uriArr[2], $uriArr[3]);
            $requestUri .= '/' . implode('/', $uriArr);
        }

        $request->setRequestUri($requestUri);
        $request->setModuleName($moduleName);
        $request->setControllerName($controllerName);
        $request->setActionName($actionName);

        return true;
    }

    public function assemble(array $info, array $query = NULL) {
        return true;
    }
}