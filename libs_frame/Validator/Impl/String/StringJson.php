<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/5/17 0017
 * Time: 11:47
 */
namespace Validator\Impl\String;

use SyConstant\Project;
use SyTool\Tool;
use Validator\BaseValidator;
use Validator\ValidatorService;

class StringJson extends BaseValidator implements ValidatorService
{
    public function __construct()
    {
        parent::__construct();
        $this->validatorType = Project::VALIDATOR_TYPE_STRING_JSON;
    }

    private function __clone()
    {
    }

    public function validator($data, $compareData): string
    {
        if ($data === null) {
            return '';
        }

        $trueData = $this->verifyStringData($data);
        if ($trueData === null) {
            return '必须是字符串';
        } elseif ((strlen($trueData) == 0) && !$compareData) {
            return '';
        } elseif (is_array(Tool::jsonDecode($trueData))) {
            return '';
        }

        return '必须是json格式';
    }
}
