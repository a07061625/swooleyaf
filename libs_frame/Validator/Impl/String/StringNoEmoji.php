<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-26
 * Time: 1:09
 */
namespace Validator\Impl\String;

use Constant\Project;
use Validator\BaseValidator;
use Validator\ValidatorService;

class StringNoEmoji extends BaseValidator implements ValidatorService {
    public function __construct() {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_STRING_TYPE_NO_EMOJI;
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
        } else if(preg_match('/[\xf0-\xf7].{3}/', $trueData) == 0){
            return '';
        } else {
            return '不允许包含表情符号';
        }
    }
}