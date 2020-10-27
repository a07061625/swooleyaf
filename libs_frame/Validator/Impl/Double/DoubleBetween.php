<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/8/11 0011
 * Time: 9:22
 */
namespace Validator\Impl\Double;

use SyConstant\Project;
use Validator\BaseValidator;
use Validator\ValidatorService;

class DoubleBetween extends BaseValidator implements ValidatorService
{
    public function __construct()
    {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_TYPE_DOUBLE_BETWEEN;
    }

    private function __clone()
    {
    }

    public function validator($data, $compareData) : string
    {
        if ($data === null) {
            return '';
        }

        $trueData = $this->verifyDoubleData($data);
        if ($trueData === null) {
            return '必须是数值';
        } elseif (!is_array($compareData)) {
            return '规则值必须是数组';
        } elseif (count($compareData) != 2) {
            return '规则值不合法';
        } elseif (!is_numeric($compareData[0])) {
            return '规则值最小值必须是数值';
        } elseif (!is_numeric($compareData[1])) {
            return '规则值最大值必须是数值';
        } elseif (bccomp($compareData[0], (string)$trueData) > 0) {
            return '不能小于' . $compareData[0];
        } elseif (bccomp($compareData[1], (string)$trueData) < 0) {
            return '不能大于' . $compareData[1];
        }

        return '';
    }
}
