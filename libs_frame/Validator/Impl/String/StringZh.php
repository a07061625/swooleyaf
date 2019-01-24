<?php
/**
 * 中文,数字,字母校验器
 * User: 姜伟
 * Date: 2017/8/12 0012
 * Time: 17:45
 */
namespace Validator\Impl\String;

use Constant\Project;
use Validator\BaseValidator;
use Validator\ValidatorService;

class StringZh extends BaseValidator implements ValidatorService {
    public function __construct() {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_STRING_TYPE_ZH;
    }

    private function __clone() {
    }

    public function validator($data, $compareData) : string {
        if ($data === null) {
            return '';
        }

        $trueData = $this->verifyStringData($data);
        if ($trueData === null) {
            return '必须是字符串';
        } else if(strlen($trueData) == 0){
            return '';
        } else if(preg_match('/[^0-9a-zA-Z\x{4e00}-\x{9fa5}]+/u', $trueData) == 0){
            return '';
        } else {
            return '只允许中文,数字,字母';
        }
    }
}