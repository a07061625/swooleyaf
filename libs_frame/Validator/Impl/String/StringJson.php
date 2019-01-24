<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/5/17 0017
 * Time: 11:47
 */
namespace Validator\Impl\String;

use Constant\Project;
use Tool\Tool;
use Validator\BaseValidator;
use Validator\ValidatorService;

class StringJson extends BaseValidator implements ValidatorService {
    public function __construct() {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_STRING_TYPE_JSON;
    }

    private function __clone() {
    }

    public function validator($data, $compareData): string {
        if ($data === null) {
            return '';
        }

        $trueData = $this->verifyStringData($data);
        if ($trueData === null) {
            return '必须是字符串';
        } else if((strlen($trueData) == 0) && !$compareData){
            return '';
        } else {
            $arr = Tool::jsonDecode($trueData);
            if(is_array($arr)){
                return '';
            }

            return '必须是json格式';
        }
    }
}