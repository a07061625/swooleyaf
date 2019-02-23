<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/1 0001
 * Time: 15:58
 */
namespace Validator\Containers;

use DesignPatterns\Singletons\SimpleValidatorSingleton;
use Tool\BaseContainer;

abstract class BaseValidatorContainer extends BaseContainer {
    public function __construct(){
    }

    /**
     * 获取绑定类
     * @param string|int $tag 对象类型标识
     * @return null|mixed
     */
    public function getObj($tag) {
        $obj = SimpleValidatorSingleton::getInstance()->getObj($tag);
        if (is_null($obj)) {
            $obj = parent::getObj($tag);
        }

        return $obj;
    }
}