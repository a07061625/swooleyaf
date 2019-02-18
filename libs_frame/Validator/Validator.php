<?php
/**
 * 数据校验器
 * User: 姜伟
 * Date: 2016/12/31 0031
 * Time: 19:59
 */
namespace Validator;

use Traits\SimpleTrait;
use Validator\Containers\ValidatorContainer;

final class Validator {
    use SimpleTrait;

    const ANNOTATION_NAME = '@SyFilter'; //校验注解名称
    const ANNOTATION_TAG_SIGN = '_sign'; //注解标识-接口签名
    const ANNOTATION_TAG_IGNORE_SIGN = '_ignoresign'; //注解标识-取消接口签名
    const ANNOTATION_TAG_SY_TOKEN = '__sytoken'; //注解标识-框架令牌

    private static $container = null;
    private static $services = [];

    /**
     * @param string $serviceType
     * @return \Validator\ValidatorService
     */
    private static function getService(string $serviceType) {
        if(is_null(self::$container)){
            self::$container = new ValidatorContainer();
        }

        if(isset(self::$services[$serviceType])){
            $service = self::$services[$serviceType];
        } else {
            $service = self::$container->getObj($serviceType);
            if(!is_null($service)){
                self::$services[$serviceType] = $service;
            }
        }

        return $service;
    }

    /**
     * 数据校验
     * @param mixed $data 待校验数据
     * @param ValidatorResult $result 校验规则数组
     * @return string
     */
    public static function validator($data,ValidatorResult $result) : string {
        $errorStr = '';
        $rules = $result->getRules();
        foreach ($rules as $ruleKey => $ruleValue) {
            $needKey = $result->getType() . '_' . $ruleKey;
            $service = self::getService($needKey);
            if ($service != null) {
                $errorStr = $service->validator($data, $ruleValue);
            } else {
                $errorStr = '校验规则不支持';
            }

            if (strlen($errorStr) > 0) {
                break;
            }
        }

        return $result->getFullError($errorStr);
    }
}