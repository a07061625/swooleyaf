<?php
/**
 * 容器基类
 * User: 姜伟
 * Date: 2017/1/18 0018
 * Time: 19:10
 */
namespace Tool;

abstract class BaseContainer {
    protected $registryMap = []; //注册集合
    protected $reflectMap = []; //绑定集合

    /**
     * @return array
     */
    public function getRegistryMap() : array {
        return $this->registryMap;
    }

    /**
     * 注入绑定
     * @param string $name 绑定名称
     * @param callable $resolver 回调函数
     */
    protected function bind(string $name,Callable $resolver) {
        $this->reflectMap[$name] = $resolver;
    }

    /**
     * 获取绑定类
     * @param string|int $tag 对象类型标识
     * @return null|mixed
     */
    public function getObj($tag) {
        $obj = null;
        $key = (string)$tag;
        if ((strlen($key) > 0) && isset($this->reflectMap[$key])) {
            $resolver = $this->reflectMap[$key];
            $obj = $resolver();
        }

        return $obj;
    }
}