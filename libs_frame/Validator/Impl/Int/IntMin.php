<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-26
 * Time: 1:09
 */
namespace Validator\Impl\Int;

use Constant\Project;
use Validator\BaseValidator;
use Validator\ValidatorService;

class IntMin extends BaseValidator implements ValidatorService {
    public function __construct() {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_INT_TYPE_MIN;
    }

    private function __clone() {
    }

    public function validator($data, $compareData): string {
        if ($data === null) {
            return '';
        }

        $trueData = $this->verifyIntData($data);
        if ($trueData === null) {
            return '必须是整数';
        } else if(is_numeric($compareData)){
            $minNum = (int)$compareData;
            if($trueData < $minNum) {
                return '不能小于' . $minNum;
            }

            return '';
        } else {
            return '规则不合法';
        }
    }
}