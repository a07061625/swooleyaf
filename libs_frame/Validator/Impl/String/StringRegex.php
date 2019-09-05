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

class StringRegex extends BaseValidator implements ValidatorService
{
    public function __construct()
    {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_STRING_TYPE_REGEX;
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
        } elseif (strlen($compareData) == 0) {
            return '规则不能为空';
        } elseif (preg_match($compareData, $trueData) > 0) {
            return '';
        } else {
            return '格式不合法';
        }
    }
}
