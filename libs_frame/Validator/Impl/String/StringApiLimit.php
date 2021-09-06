<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/9/6
 * Time: 13:48
 */

namespace Validator\Impl\String;

use SyConstant\Project;
use SyTool\Tool;
use SyTrait\Validators\ApiLimitTrait;
use Validator\BaseValidator;
use Validator\ValidatorService;

/**
 * Class StringApiLimit
 *
 * @package Validator\Impl\String
 */
class StringApiLimit extends BaseValidator implements ValidatorService
{
    use ApiLimitTrait;

    public function __construct()
    {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_TYPE_STRING_API_LIMIT;
    }

    private function __clone()
    {
    }

    public function validator($data, $compareData): string
    {
        $expireTime = $this->getApiExpireTime();
        if ($expireTime < 0) {
            return '接口未授权';
        }

        $nowTime = Tool::getNowTime();
        if ($expireTime <= $nowTime) {
            return '接口已到期';
        }

        return '';
    }
}
