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

class IntBetween extends BaseValidator implements ValidatorService {
    public function __construct() {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_INT_TYPE_BETWEEN;
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
        } else if(!is_string($compareData)){
            return '取值规则不合法';
        }

        $acceptArr = explode(',', $compareData);
        if(count($acceptArr) != 2){
            return '取值规则不合法';
        }
        if((!is_numeric($acceptArr[0])) || (!is_numeric($acceptArr[1]))){
            return '取值规则不合法';
        }

        $minNum = (int)$acceptArr[0];
        $maxNum = (int)$acceptArr[1];
        if($minNum > $maxNum) {
            return '取值范围最大值不能小于最小值';
        } else if($trueData < $minNum) {
            return '不能小于' . $minNum;
        } else if($trueData > $maxNum) {
            return '不能大于' . $maxNum;
        } else {
            return '';
        }
    }
}