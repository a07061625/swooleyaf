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
        $uriArr = explode('/', $request->getRequestUri());
        $moduleName = strlen($uriArr[1]) > 0 ? ucfirst($uriArr[1]) : $this->defaultModule;
        if(!isset($this->acceptModules[$moduleName])){
            throw new ValidatorException('模块不支持', ErrorCode::COMMON_ROUTE_MODULE_NOT_ACCEPT);
        }

        $controllerName = isset($uriArr[2]) ? ucfirst($uriArr[2]) : $this->defaultController;
        $actionName = isset($uriArr[3]) ? lcfirst($uriArr[3]) : $this->defaultAction;

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