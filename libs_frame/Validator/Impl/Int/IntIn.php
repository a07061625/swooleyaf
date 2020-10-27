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

class IntIn extends BaseValidator implements ValidatorService
{
    public function __construct()
    {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_TYPE_INT_IN;
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
        } elseif (count($compareData) == 0) {
            return '规则值不能为空';
        }
        $needNum = 0;
        foreach ($compareData as $eData) {
            if (!is_int($eData)) {
                $needNum = 2;

                break;
            } elseif ($eData == $trueData) {
                $needNum = 1;

                break;
            }
        }
        if ($needNum == 1) {
            return '';
        } elseif ($needNum == 0) {
            return '不在取值范围';
        }

        return '规则值元素必须都是整数';
    }
}
