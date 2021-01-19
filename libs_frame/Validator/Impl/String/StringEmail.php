<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-26
 * Time: 1:09
 */

namespace Validator\Impl\String;

use SyConstant\Project;
use SyConstant\ProjectBase;
use Validator\BaseValidator;
use Validator\ValidatorService;

class StringEmail extends BaseValidator implements ValidatorService
{
    public function __construct()
    {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_TYPE_STRING_EMAIL;
    }

    private function __clone()
    {
    }

    public function validator($data, $compareData): string
    {
        if (null === $data) {
            return '';
        }

        $trueData = $this->verifyStringData($data);
        if (null === $trueData) {
            return '必须是字符串';
        }
        if ((0 == \strlen($trueData)) && !$compareData) {
            return '';
        }
        if (preg_match(ProjectBase::REGEX_EMAIL, $trueData) > 0) {
            return '';
        }

        return '格式必须是邮箱';
    }
}
