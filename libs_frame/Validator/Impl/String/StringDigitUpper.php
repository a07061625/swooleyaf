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

class StringDigitUpper extends BaseValidator implements ValidatorService
{
    public function __construct()
    {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_TYPE_STRING_DIGIT_UPPER;
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
        } elseif ((strlen($trueData) == 0) && !$compareData) {
            return '';
        } elseif (ctype_alnum($trueData) && (strtoupper($trueData) == $trueData)) {
            return '';
        }

        return '格式必须都是数字和大写字母';
    }
}
