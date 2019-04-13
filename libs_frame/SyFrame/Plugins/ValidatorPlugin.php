<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/6/22 0022
 * Time: 14:11
 */
namespace SyFrame\Plugins;

use Constant\ErrorCode;
use Constant\Server;
use Exception\Validator\ValidatorException;
use Reflection\BaseReflect;
use Request\SyRequest;
use Validator\Validator;
use Yaf\Plugin_Abstract;
use Yaf\Registry;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;

class ValidatorPlugin extends Plugin_Abstract {
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
        $validatorKey = Server::REGISTRY_NAME_VALIDATOR_PREFIX . hash('crc32b', $controllerClass . '_' . $methodName);
        $validatorList = Registry::get($validatorKey);
        if(!is_array($validatorList)){
            $validatorList = BaseReflect::getValidatorAnnotations($controllerClass, $methodName);
            Registry::set($validatorKey, $validatorList);
        }

        foreach ($validatorList as $eValidator) {
            $data = SyRequest::getParams($eValidator->getField());
            $verifyRes = Validator::validator($data, $eValidator);
            if (strlen($verifyRes) > 0) {
                throw new ValidatorException($verifyRes, ErrorCode::COMMON_PARAM_ERROR);
            }
        }
    }
}