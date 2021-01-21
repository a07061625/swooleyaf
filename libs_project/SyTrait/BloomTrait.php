<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/21 0021
 * Time: 10:16
 */

namespace SyTrait;

use SyFilters\Bloom\MyTest;

/**
 * Trait BloomTrait
 *
 * @package SyTrait
 */
trait BloomTrait
{
    /**
     * 初始化过滤器
     */
    private function initFilters()
    {
        $this->filters['a01'] = new MyTest(100000);
    }
}
