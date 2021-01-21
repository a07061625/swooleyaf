<?php
/**
 * 布隆过滤器单例
 * User: 姜伟
 * Date: 2021/1/21 0021
 * Time: 10:09
 */

namespace DesignPatterns\Singletons;

use SyConstant\Project;
use SyTool\Tool;
use SyTrait\BloomTrait;
use SyTrait\SingletonTrait;

/**
 * Class BloomSingleton
 *
 * @package DesignPatterns\Singletons
 */
class BloomSingleton
{
    use SingletonTrait;
    use BloomTrait;

    /**
     * 过滤器列表
     *
     * @var array
     */
    private $filters = [];
    /**
     * 刷新时间戳
     *
     * @var int
     */
    private $refreshTime = 0;

    private function __construct()
    {
        $this->initFilters();
    }

    /**
     * @return \DesignPatterns\Singletons\BloomSingleton
     */
    public static function getInstance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 添加过滤器键名
     *
     * @param string $tag 过滤器标识
     * @param string $key 键名
     */
    public function addKey(string $tag, string $key)
    {
        $filter = $this->getLocalFilter($tag);
        if (null !== $filter) {
            $filter->addKey($key);
        }
    }

    /**
     * 判断过滤器键名是否存在
     *
     * @param string $tag 过滤器标识
     * @param string $key 键名
     */
    public function existKey(string $tag, string $key): bool
    {
        $filter = $this->getLocalFilter($tag);
        if (null === $filter) {
            return false;
        }

        return $filter->existKey($key);
    }

    /**
     * 获取本地过滤器
     *
     * @param string $tag 过滤器标识
     *
     * @return null|\SyFilters\BloomFilter 过滤器
     */
    private function getLocalFilter(string $tag): ?\SyFilters\BloomFilter
    {
        $nowTime = Tool::getNowTime();
        if ($nowTime > $this->refreshTime) {
            $nowFilters = [];
            foreach ($this->filters as $eTag => $eFilter) {
                $eFilter->refreshBitmap();
                $nowFilters[$eTag] = $eFilter;
            }
            $this->filters = $nowFilters;
            $this->refreshTime = $nowTime + Project::TIME_EXPIRE_LOCAL_BLOOM_REFRESH;
        }

        return Tool::getArrayVal($this->filters, $tag, null);
    }
}
