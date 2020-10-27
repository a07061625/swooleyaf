<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/6/22 0022
 * Time: 14:11
 */
namespace SyFrame\Plugins;

use Request\SyRequest;
use SyConstant\ErrorCode;
use SyConstant\SyInner;
use SyException\Validator\ValidatorException;
use SyReflection\BaseReflect;
use Validator\Validator;
use Yaf\Plugin_Abstract;
use Yaf\Registry;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;

class ValidatorPlugin extends Plugin_Abstract
{
    private $validatorMap = [];

    public function __construct()
    {
        $this->validatorMap = [];
    }

    private function __clone()
    {
    }

    /**
     * @param \Yaf\Request_Abstract  $request
     * @param \Yaf\Response_Abstract $response
     *
     * @throws \SyException\Validator\ValidatorException
     */
    public function preDispatch(Request_Abstract $request, Response_Abstract $response)
    {
        $controllerName = $request->getControllerName() . 'Controller';
        $actionName = $request->getActionName() . 'Action';
        $validatorList = $this->getValidatorList($controllerName, $actionName);
        foreach ($validatorList as $eValidator) {
            $data = SyRequest::getParams($eValidator->getField());
            $verifyRes = Validator::validator($data, $eValidator);
            if (strlen($verifyRes) > 0) {
                throw new ValidatorException($verifyRes, ErrorCode::COMMON_PARAM_ERROR);
            }
        }
    }

    /**
     * @param string $controllerName
     * @param string $actionName
     *
     * @return array
     *
     * @throws \SyException\Validator\ValidatorException
     */
    private function getValidatorList(string $controllerName, string $actionName) : array
    {
        $key = $_SERVER['SYKEY-CA'];
        $validatorTag = $this->validatorMap[$key] ?? null;
        if (is_string($validatorTag)) {
            return Registry::get($validatorTag);
        }

        $validatorList = BaseReflect::getControllerFilters($controllerName, $actionName);
        $validatorTag = SyInner::REGISTRY_NAME_PREFIX_VALIDATOR . hash('crc32b', $key);
        $this->validatorMap[$key] = $validatorTag;
        Registry::set($validatorTag, $validatorList);

        return $validatorList;
    }
}
