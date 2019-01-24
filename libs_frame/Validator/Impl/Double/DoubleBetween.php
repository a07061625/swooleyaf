<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/8/11 0011
 * Time: 9:22
 */
namespace Validator\Impl\Double;

use Constant\Project;
use Validator\BaseValidator;
use Validator\ValidatorService;

class DoubleBetween  extends BaseValidator implements ValidatorService {
    public function __construct() {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_DOUBLE_TYPE_BETWEEN;
    }

    private function __clone() {
    }

    public function validator($data, $compareData) : string {
        if ($data === null) {
            return '';
        }

        $trueData = $this->verifyDoubleData($data);
        if ($trueData === null) {
            return '必须是数值';
        } else if (!is_string($compareData)) {
            return '取值规则不合法';
        }

        $acceptArr = explode(',', $compareData);
        if(count($acceptArr) != 2){
            return '取值规则不合法';
        } else if(!is_numeric($acceptArr[0])){
            return '取值规则不合法';
        } else if(!is_numeric($acceptArr[1])){
            return '取值规则不合法';
        }

        if(bccomp($acceptArr[0], $acceptArr[1]) > 0){
            return '取值范围最大值不能小于最小值';
        } else if(bccomp($acceptArr[0], (string)$trueData) > 0){
            return '不能小于' . $acceptArr[0];
        } else if(bccomp($acceptArr[1], (string)$trueData) < 0){
            return '不能大于' . $acceptArr[1];
        } else {
            return '';
        }
    }
}