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

class IntMax extends BaseValidator implements ValidatorService {
    public function __construct() {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_INT_TYPE_MAX;
    }

    private function __clone() {
    }

    public function validator($data, $compareData) : string {
        if ($data === null) {
            return '';
        }

        $trueData = $this->verifyIntData($data);
        if ($trueData === null) {
            return '必须是整数';
        } else if(is_numeric($compareData)){
            $maxNum = (int)$compareData;
            if($trueData > $maxNum) {
                return '不能大于' . $maxNum;
            }

            return '';
        } else {
            return '规则不合法';
        }
    }
}