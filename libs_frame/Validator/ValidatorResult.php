<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-26
 * Time: 17:20
 */
namespace Validator;

class ValidatorResult {
    const TYPE_INT = 'int'; //校验器类型-整数校验器
    const TYPE_STRING = 'string'; //校验器类型-字符串校验器
    const TYPE_DOUBLE = 'double'; //校验器类型-浮点数校验器

    /**
     * 字段解释
     * @var string
     */
    private $explain = '';

    /**
     * 校验器类型
     * @var string
     */
    private $type = '';

    /**
     * 校验字段名
     * @var string
     */
    private $field = '';

    /**
     * 校验规则数组
     * @var array
     */
    private $rules = [];

    public function __construct() {
    }

    private function __clone(){
    }

    /**
     * @param string $explain
     */
    public function setExplain(string $explain) {
        $this->explain = $explain;
    }

    public function setType(string $type) {
        if (in_array($type, [self::TYPE_INT, self::TYPE_STRING, self::TYPE_DOUBLE])) {
            $this->type = $type;
        }
    }

    public function getType() : string {
        return $this->type;
    }

    /**
     * @param string $field
     */
    public function setField(string $field) {
        $this->field = $field;
    }

    /**
     * @return string
     */
    public function getField() : string {
        return $this->field;
    }

    /**
     * @return array
     */
    public function getRules() : array {
        return $this->rules;
    }

    /**
     * @param array $rules
     */
    public function setRules(array $rules) {
        $this->rules = $rules;
    }

    /**
     * 获取完整的错误信息
     * @param string $error 错误信息
     * @return string
     */
    public function getFullError(string $error) : string {
        if(strlen($error) == 0){
            return '';
        } else if(strlen($this->explain) > 0){
            return $this->explain . $error;
        } else {
            return $this->field . $error;
        }
    }
}