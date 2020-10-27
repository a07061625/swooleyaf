<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/8/11 0011
 * Time: 9:23
 */
namespace Validator\Impl\Double;

use SyConstant\Project;
use Validator\BaseValidator;
use Validator\ValidatorService;

class DoubleMin extends BaseValidator implements ValidatorService
{
    public function __construct()
    {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_TYPE_DOUBLE_MIN;
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
        } elseif (!is_numeric($compareData)) {
            return '规则值必须是数值';
        } elseif (bccomp((string)$compareData, (string)$trueData) > 0) {
            return '不能小于' . $compareData;
        }

        return '';
    }
}
