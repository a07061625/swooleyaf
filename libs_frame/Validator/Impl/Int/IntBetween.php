<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-26
 * Time: 1:09
 */
namespace Validator\Impl\Int;

use SyConstant\Project;
use Validator\BaseValidator;
use Validator\ValidatorService;

class IntBetween extends BaseValidator implements ValidatorService
{
    public function __construct()
    {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_TYPE_INT_BETWEEN;
    }

    private function __clone()
    {
    }

    public function validator($data, $compareData) : string
    {
        if ($data === null) {
            return '';
        }

        $trueData = $this->verifyIntData($data);
        if ($trueData === null) {
            return '必须是整数';
        } elseif (!is_array($compareData)) {
            return '规则值必须是数组';
        } elseif (count($compareData) != 2) {
            return '规则值不合法';
        } elseif (!is_int($compareData[0])) {
            return '规则值最小值必须是整数';
        } elseif (!is_int($compareData[1])) {
            return '规则值最大值必须是整数';
        } elseif ($compareData[0] > $compareData[1]) {
            return '规则值最大值不能小于最小值';
        } elseif ($trueData < $compareData[0]) {
            return '不能小于' . $compareData[0];
        } elseif ($trueData > $compareData[1]) {
            return '不能大于' . $compareData[1];
        }

        return '';
    }
}
