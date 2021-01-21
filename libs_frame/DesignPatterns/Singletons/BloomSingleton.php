<?php
/**
 * 布隆过滤器单例
 * User: 姜伟
 * Date: 2021/1/21 0021
 * Time: 10:09
 */
namespace DesignPatterns\Singletons;

use SyTrait\BloomTrait;
use SyTrait\SingletonTrait;

/**
 * Class BloomSingleton
 * @package DesignPatterns\Singletons
 */
class BloomSingleton
{
    use SingletonTrait;
    use BloomTrait;

    /**
     * 过滤器列表
     * @var array
     */
    private $filters = [];

    private function __construct()
    {
        $this->initFilters();
    }

    /**
     * @return \DesignPatterns\Singletons\BloomSingleton
     */
    public static function getInstance() : BloomSingleton
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 添加过滤器键名
     * @param string $tag 过滤器标识
     * @param string $key 键名
     */
    public function addKey(string $tag, string $key)
    {
        if (isset($this->filters[$tag])) {
            $this->filters[$tag]->addKey($key);
        }
    }

    /**
     * 判断过滤器键名是否存在
     * @param string $tag 过滤器标识
     * @param string $key 键名
     * @return bool
     */
    public function existKey(string $tag, string $key) : bool
    {
        if (isset($this->filters[$tag])) {
            return $this->filters[$tag]->existKey($key);
        }

        return false;
    }
}
