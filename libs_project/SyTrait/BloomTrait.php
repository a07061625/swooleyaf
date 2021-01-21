<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/21 0021
 * Time: 10:16
 */
namespace SyTrait;

use SyTool\BloomFilter;

/**
 * Trait BloomTrait
 * @package SyTrait
 */
trait BloomTrait
{
    /**
     * 初始化过滤器
     * @throws \SyException\Common\ErrorException
     */
    private function initFilters()
    {
        $this->filters['a01'] = new BloomFilter(100000);
    }
}
