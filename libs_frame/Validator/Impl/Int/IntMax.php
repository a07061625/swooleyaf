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

class IntMax extends BaseValidator implements ValidatorService
{
    public function __construct()
    {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_TYPE_INT_MAX;
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
            return '必须是数值';
        } elseif (!is_int($compareData)) {
            return '规则值必须是整数';
        } elseif ($trueData > $compareData) {
            return '不能大于' . $compareData;
        }

        return '';
    }
}
