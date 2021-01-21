<?php
/**
 * 布隆过滤器
 * User: 姜伟
 * Date: 2021/1/21 0021
 * Time: 8:48
 */

namespace SyFilters;

use SyConstant\ErrorCode;
use SyException\Common\ErrorException;

/**
 * Class BloomFilter
 *
 * @package SyFilters
 */
abstract class BloomFilter
{
    /**
     * bitmap对象
     *
     * @var \GMP
     */
    protected $bitmap;
    /**
     * 数组元素最大个数
     *
     * @var int
     */
    protected $maxNum = 0;

    public function __construct(int $num)
    {
        if ($num > 10) {
            $this->maxNum = $num;
            $this->bitmap = gmp_init(0);
            gmp_setbit($this->bitmap, $num, true);
        } else {
            throw new ErrorException('元素最大个数不合法', ErrorCode::COMMON_SERVER_ERROR);
        }
    }

    private function __clone()
    {
    }

    /**
     * 添加键名
     *
     * @param string $key 键名
     */
    public function addKey(string $key)
    {
        $index = $this->getBitmapIndex($key);
        gmp_setbit($this->bitmap, $index, true);
    }

    /**
     * 判断键名是否存在
     *
     * @param string $key 键名
     */
    public function existKey(string $key): bool
    {
        $index = $this->getBitmapIndex($key);
        $existIndex = gmp_scan1($this->bitmap, $index);

        return $existIndex == $index;
    }

    /**
     * 获取bitmap索引值
     *
     * @param string $key 键名
     */
    private function getBitmapIndex(string $key): int
    {
        return crc32($key) % $this->maxNum;
    }

    /**
     * 刷新bitmap,用于进程重启,微服务情况下
     */
    abstract public function refreshBitmap();
}
