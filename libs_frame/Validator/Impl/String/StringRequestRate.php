<?php
/**
 * 校验接口请求频率(3秒时间内的请求次数)
 * User: 姜伟
 * Date: 2020/10/24 0024
 * Time: 21:48
 */

namespace Validator\Impl\String;

use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Validator\ValidatorException;
use SyTrait\Validators\RequestRateTrait;
use Validator\BaseValidator;
use Validator\ValidatorService;

/**
 * Class StringRequestRate
 *
 * @package Validator\Impl\String
 */
class StringRequestRate extends BaseValidator implements ValidatorService
{
    use RequestRateTrait;

    public function __construct()
    {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_TYPE_STRING_REQUEST_RATE;
    }

    private function __clone()
    {
    }

    /**
     * @param string $data
     * @param int    $compareData
     *
     * @throws \SyException\Validator\ValidatorException
     */
    public function validator($data, $compareData): string
    {
        $rateNum = $this->getRateNum();
        if (($rateNum > 0) && ($rateNum > $compareData)) {
            throw new ValidatorException('请求频率超过接口限制', ErrorCode::COMMON_SERVER_ERROR);
        }

        return '';
    }
}
