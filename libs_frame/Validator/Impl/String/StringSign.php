<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-26
 * Time: 1:09
 */

namespace Validator\Impl\String;

use Request\RequestSign;
use SyConstant\Project;
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
     * @throws \SyException\Validator\SignException
     */
    public function validator($data, $compareData): string
    {
        RequestSign::checkSign();

        return '';
    }
}
