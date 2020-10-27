<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-26
 * Time: 1:09
 */
namespace Validator\Impl\String;

use SyConstant\Project;
use Validator\BaseValidator;
use Validator\ValidatorService;

class StringMax extends BaseValidator implements ValidatorService
{
    public function __construct()
    {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_TYPE_STRING_MAX;
    }

    private function __clone()
    {
    }

    public function validator($data, $compareData) : string
    {
        if ($data === null) {
            return '';
        }

        $trueData = $this->verifyStringData($data);
        if ($trueData === null) {
            return '必须是字符串';
        } elseif (!is_int($compareData)) {
            return '规则值必须是整数';
        } elseif (mb_strlen($trueData) > $compareData) {
            return '长度不能大于' . $compareData . '个字';
        }

        return '';
    }
}
