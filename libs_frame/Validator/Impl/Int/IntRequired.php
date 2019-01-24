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

class IntRequired extends BaseValidator implements ValidatorService {
    public function __construct() {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_INT_TYPE_REQUIRED;
    }

    private function __clone() {
    }

    public function validator($data, $compareData) : string {
        if($data === null) {
            return '必须填写';
        }

        return '';
    }
}