<?php
/**
 * 数据校验器基类
 * User: 姜伟
 * Date: 2016/12/31 0031
 * Time: 18:09
 */
namespace Validator;

abstract class BaseValidator {
    public $validatorType = ''; //校验器类型

    public function __construct() {
    }

    public function verifyIntData($data) {
        return is_numeric($data) && (strpos($data, '.') === false) ? (int)$data : null;
    }

    public function verifyDoubleData($data) {
        return is_numeric($data) ? (double)$data : null;
    }

    public function verifyStringData($data) {
        return is_string($data) ? (string)$data : null;
    }
}