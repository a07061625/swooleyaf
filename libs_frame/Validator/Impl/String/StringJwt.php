<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-26
 * Time: 1:09
 */
namespace Validator\Impl\String;

use SyConstant\ErrorCode;
use SyConstant\Project;
use SyConstant\Server;
use DesignPatterns\Factories\CacheSimpleFactory;
use SyException\Validator\ValidatorException;
use Validator\BaseValidator;
use Validator\ValidatorService;
use Yaf\Registry;

class StringJwt extends BaseValidator implements ValidatorService
{
    public function __construct()
    {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_STRING_TYPE_JWT;
    }

    private function __clone()
    {
    }

    public function validator($data, $compareData) : string
    {
        $jwtData = Registry::get(Server::REGISTRY_NAME_RESPONSE_JWT_DATA);
        if (($compareData == 1) && (strlen($jwtData['uid']) > 0)) {
            $redisKey = Project::REDIS_PREFIX_SESSION_JWT_REFRESH . $jwtData['uid'];
            $redisData = CacheSimpleFactory::getRedisInstance()->get($redisKey);
            if (is_string($redisData) && ($redisData != $jwtData['rid'])) {
                throw new ValidatorException('会话已更新', ErrorCode::SESSION_JWT_REFRESH_ERROR);
            }
        }

        return '';
    }
}
