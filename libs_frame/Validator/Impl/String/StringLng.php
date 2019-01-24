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

class StringLng extends BaseValidator implements ValidatorService {
    public function __construct() {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_STRING_TYPE_LNG;
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
        } else if((strlen($trueData) == 0) && !$compareData){
            return '';
        } else if(!is_numeric($trueData)){
            return '必须是数值';
        } else if(($trueData < -180) || ($trueData > 180)){
            return '格式不合法';
        } else {
            return '';
        }
    }
}