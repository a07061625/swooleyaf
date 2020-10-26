<?php
/**
 * 校验接口请求频率(3秒时间内的请求次数)
 * User: 姜伟
 * Date: 2020/10/24 0024
 * Time: 21:48
 */
namespace Validator\Impl\String;

use DesignPatterns\Factories\CacheSimpleFactory;
use SyConstant\Project;
use SyTool\Tool;
use Validator\BaseValidator;
use Validator\ValidatorService;

/**
 * Class StringRequestRate
 *
 * @package Validator\Impl\String
 */
class StringRequestRate extends BaseValidator implements ValidatorService
{
    public function __construct()
    {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_STRING_TYPE_REQUEST_RATE;
    }

    private function __clone()
    {
    }

    public function validator($data, $compareData) : string
    {
        if (!is_int($compareData)) {
            return '规则值必须为整数';
        } elseif ($compareData < 0) {
            return '规则值不能为负数';
        }

        if (isset($_SERVER['HTTP_sy-client'])) {
            $clientId = trim($_SERVER['HTTP_sy-client']);
        } else {
            $clientId = '';
        }
        if (strlen($clientId) > 0) {
            $nowTime = Tool::getNowTime();
            $tag = ($nowTime - $nowTime % 3) . $clientId . $_SERVER['SYKEY-MC'] . $_SERVER['SYKEY-CA'];
            $cacheKey = Project::REDIS_PREFIX_REQUEST_RATE . md5($tag);
            $cacheData = CacheSimpleFactory::getRedisInstance()->incr($cacheKey);
            CacheSimpleFactory::getRedisInstance()->expire($cacheKey, 6);
            if ($cacheData > $compareData) {
                return '请求频率超过接口限制';
            }
        }

        return '';
    }
}
