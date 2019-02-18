<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-26
 * Time: 1:09
 */
namespace Validator\Impl\String;

use Constant\ErrorCode;
use Constant\Project;
use Exception\Validator\ValidatorException;
use Request\RequestSign;
use SyServer\HttpServer;
use Validator\BaseValidator;
use Validator\ValidatorService;

class StringSign extends BaseValidator implements ValidatorService {
    public function __construct() {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_STRING_TYPE_SIGN;
    }

    private function __clone() {
    }

    public function validator($data, $compareData) : string {
        $sign = RequestSign::checkSign();
        $checkRes = HttpServer::addApiSign($sign);
        if ($checkRes) {
            return '';
        } else {
            throw new ValidatorException('签名值已存在', ErrorCode::SIGN_ERROR);
        }
    }
}