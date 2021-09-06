<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/9/6
 * Time: 13:48
 */
namespace Validator\Impl\String;

use SyConstant\Project;
use Validator\BaseValidator;
use Validator\ValidatorService;

/**
 * Class StringApiLimit
 * @package Validator\Impl\String
 */
class StringApiLimit extends BaseValidator implements ValidatorService
{
    public function __construct()
    {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_TYPE_STRING_ZH;
    }

    private function __clone()
    {
    }

    public function validator($data, $compareData) : string
    {
        if ($data === null) {
            return '';
        }

        $trueData = $this->verifyStringData($data);
        if ($trueData === null) {
            return '必须是字符串';
        } elseif (strlen($trueData) == 0) {
            return '';
        } elseif (preg_match('/[^0-9a-zA-Z\x{4e00}-\x{9fa5}]+/u', $trueData) == 0) {
            return '';
        }

        return '';
    }
}
