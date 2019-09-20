<?php
/**
 * 控制器方法存在插件
 * User: 姜伟
 * Date: 2017/6/22 0022
 * Time: 9:42
 */
namespace SyFrame\Plugins;

use SyConstant\ErrorCode;
use SyConstant\SyInner;
use SyException\Validator\ValidatorException;
use Yaf\Plugin_Abstract;
use Yaf\Registry;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;

class MethodExistPlugin extends Plugin_Abstract
{
    /**
     * 已存在的控制器数组
     * @var array
     */
    private $controllerMap = [];

    public function __construct()
    {
        $this->controllerMap = [];
    }

    private function __clone()
    {
    }

    private function getActions(string $moduleName, string $controllerName) : array
    {
        $controllerKey = $_SERVER['SYKEY-MC'];
        $controllerTag = $this->controllerMap[$controllerKey] ?? null;
        if (is_string($controllerTag)) {
            return [
                'tag' => $controllerTag,
                'list' => Registry::get($controllerTag),
            ];
        }

        if ($moduleName == 'Index') {
            $file = APP_PATH . '/application/controllers/' . $controllerName . '.php';
        } else {
            $file = APP_PATH . '/application/modules/' . $moduleName . '/controllers/' . $controllerName . '.php';
        }
        if (file_exists($file)) {
            require_once $file;
        } else {
            throw new ValidatorException('控制器不存在', ErrorCode::COMMON_ROUTE_CONTROLLER_NOT_EXIST);
        }

        $controllerTag = SyInner::REGISTRY_NAME_PREFIX_CONTROLLER . hash('crc32b', $controllerKey);
        $this->controllerMap[$controllerKey] = $controllerTag;
        Registry::set($controllerTag, []);
        return [
            'tag' => $controllerTag,
            'list' => [],
        ];
    }

    public function routerShutdown(Request_Abstract $request, Response_Abstract $response)
    {
        $uriArr = explode('/', $request->getRequestUri());
        $actions = $this->getActions($uriArr[1], $uriArr[2]);
        $actionName = strtolower($uriArr[3]);
        if (!isset($actions['list'][$actionName])) {
            if (method_exists('\\' . $uriArr[2] . 'Controller', $uriArr[3] . 'Action')) {
                $actions['list'][$actionName] = 1;
                Registry::set($actions['tag'], $actions['list']);
            } else {
                throw new ValidatorException('方法不存在', ErrorCode::COMMON_ROUTE_ACTION_NOT_EXIST);
            }
        }
    }
}
