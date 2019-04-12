<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-26
 * Time: 1:09
 */
namespace Validator\Impl\String;

use Constant\ErrorCode;
use Constant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use Exception\Validator\ValidatorException;
use Tool\SessionTool;
use Validator\BaseValidator;
use Validator\ValidatorService;

class StringJwt extends BaseValidator implements ValidatorService {
    public function __construct() {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_STRING_TYPE_JWT;
    }

    private function __clone() {
    }

    public function validator($data, $compareData) : string {
        $checkRes = SessionTool::checkSessionJwt();
        if(strlen($checkRes['error']) > 0){
            throw new ValidatorException($checkRes['error'], ErrorCode::SESSION_JWT_SIGN_ERROR);
        }
        if($checkRes['exp'] < time()){
            throw new ValidatorException('会话已过期', ErrorCode::SESSION_JWT_REFRESH_ERROR);
        }
        if($compareData && (strlen($checkRes['tag']) > 0)){
            $redisKey = Project::REDIS_PREFIX_SESSION_JWT_REFRESH . $checkRes['tag'];
            $redisData = CacheSimpleFactory::getRedisInstance()->get($redisKey);
            if(is_string($redisData) && ($redisData != $checkRes['rid'])){
                throw new ValidatorException('会话已更新', ErrorCode::SESSION_JWT_REFRESH_ERROR);
            }
        }

        return '';
    }
}