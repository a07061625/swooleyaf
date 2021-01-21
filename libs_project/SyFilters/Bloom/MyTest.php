<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/21 0021
 * Time: 15:13
 */

namespace SyFilters\Bloom;

use SyFilters\BloomFilter;

/**
 * Class MyTest
 *
 * @package SyFilters\Bloom
 *
 * @internal
 * @coversNothing
 */
final class MyTest extends BloomFilter
{
    public function __construct(int $num)
    {
        parent::__construct($num);
    }

    private function __clone()
    {
    }

    public function refreshBitmap()
    {
        //获取redis缓存的key并依次赋值给bitmap
    }
}
