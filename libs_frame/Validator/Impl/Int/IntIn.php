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

class IntIn extends BaseValidator implements ValidatorService {
    public function __construct() {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_INT_TYPE_IN;
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
        } else if((!is_string($compareData)) && (!is_numeric($compareData))){
            return '取值规则不合法';
        } else if(preg_match('/^(\,[\-]?\d+)+$/', ',' . $compareData) > 0){
            $acceptTag = false;
            $acceptArr = explode(',', $compareData);
            array_unique($acceptArr);

            foreach($acceptArr as $eAccept) {
                $eNum = (int)$eAccept;
                if($eNum === $trueData) {
                    $acceptTag = true;
                    break;
                }
            }

            return $acceptTag ? '' : '不在取值范围';
        } else {
            return '取值规则不合法';
        }
    }
}