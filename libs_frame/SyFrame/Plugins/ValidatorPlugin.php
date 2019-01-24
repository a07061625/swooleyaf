<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/6/22 0022
 * Time: 14:11
 */
namespace SyFrame\Plugins;

use Constant\ErrorCode;
use Exception\Validator\ValidatorException;
use Reflection\BaseReflect;
use Request\SyRequest;
use Validator\Validator;
use Yaf\Plugin_Abstract;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;

class ValidatorPlugin extends Plugin_Abstract {
    /**
     * 校验列表
     * @var array
     */
    private static $verifyList = [];

    public function __construct() {
    }

    private function __clone() {
    }

    /**
     * @param \Yaf\Request_Abstract $request
     * @param \Yaf\Response_Abstract $response
     * @return void
     * @throws \Exception\Validator\ValidatorException
     */
    public function preDispatch(Request_Abstract $request,Response_Abstract $response) {
        $controllerClass = $request->getControllerName() . 'Controller';
        $methodName = $request->getActionName() . 'Action';
        $verifyKey = strtolower($controllerClass . '_' . $methodName);
        if(!isset(self::$verifyList[$verifyKey])){
            self::$verifyList[$verifyKey] = BaseReflect::getValidatorAnnotations($controllerClass, $methodName);
        }
        foreach (self::$verifyList[$verifyKey] as $eVerify) {
            $data = SyRequest::getParams($eVerify->getField());
            $verifyRes = Validator::validator($data, $eVerify);
            if (strlen($verifyRes) > 0) {
                throw new ValidatorException($verifyRes, ErrorCode::COMMON_PARAM_ERROR);
            }
        }
    }
}