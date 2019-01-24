<?php
/**
 * 校验器接口类
 * User: 姜伟
 * Date: 2016/12/31 0031
 * Time: 18:03
 */
namespace Validator;

interface ValidatorService {
    /**
     * @param mixed $data 要校验的数据
     * @param mixed $compareData 比对的数据
     * @return string 校验结果,空字符串表示校验通过,否则为不通过
     */
    public function validator($data, $compareData) : string;
}