<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-26
 * Time: 1:09
 */
namespace Validator\Impl\String;

use Request\RequestSign;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Validator\ValidatorException;
use SyServer\HttpServer;
use Validator\BaseValidator;
use Validator\ValidatorService;

class StringSign extends BaseValidator implements ValidatorService
{
    public function __construct()
    {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_TYPE_STRING_SIGN;
    }

    private function __clone()
    {
    }

    /**
     * @param string $data
     * @param int    $compareData
     *
     * @return string
     *
     * @throws \SyException\Validator\SignException
     * @throws \SyException\Validator\ValidatorException
     */
    public function validator($data, $compareData) : string
    {
        $sign = RequestSign::checkSign();
        $checkRes = HttpServer::addApiSign($sign);
        if ($checkRes) {
            return '';
        }

        throw new ValidatorException('签名值已存在', ErrorCode::SIGN_ERROR);
    }
}
