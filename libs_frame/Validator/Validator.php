<?php
/**
 * 数据校验器
 * User: 姜伟
 * Date: 2016/12/31 0031
 * Time: 19:59
 */
namespace Validator;

use SyTrait\SimpleTrait;
use Validator\Containers\ValidatorContainer;

final class Validator
{
    use SimpleTrait;

    /**
     * @var \Validator\Containers\ValidatorContainer
     */
    private static $container = null;
    private static $services = [];

    public static function init()
    {
        self::$container = new ValidatorContainer();
        self::$services = [];
    }

    /**
     * 数据校验
     *
     * @param mixed           $data   待校验数据
     * @param ValidatorResult $result 校验规则数组
     *
     * @return string
     */
    public static function validator($data, ValidatorResult $result) : string
    {
        $errorStr = '';
        $rules = $result->getRules();
        foreach ($rules as $ruleKey => $ruleValue) {
            $needKey = $result->getType() . $ruleKey;
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

    /**
     * @param string $serviceType
     *
     * @return \Validator\ValidatorService
     */
    private static function getService(string $serviceType)
    {
        if (isset(self::$services[$serviceType])) {
            $service = self::$services[$serviceType];
        } else {
            $service = self::$container->getObj($serviceType);
            if (!is_null($service)) {
                self::$services[$serviceType] = $service;
            }
        }

        return $service;
    }
}
