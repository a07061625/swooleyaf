<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/13 0013
 * Time: 10:32
 */
namespace SyTrait;

/**
 * Class SimpleConfigTrait
 *
 * @package SyTrait
 */
trait SimpleConfigTrait
{
    /**
     * 配置有效状态
     *
     * @var bool
     */
    private $valid = false;

    /**
     * 配置过期时间戳
     *
     * @var int
     */
    private $expireTime = 0;

    /**
     * @return bool
     */
    public function isValid() : bool
    {
        return $this->valid;
    }

    /**
     * @param bool $valid
     */
    public function setValid(bool $valid)
    {
        $this->valid = $valid;
    }

    /**
     * @return int
     */
    public function getExpireTime() : int
    {
        return $this->expireTime;
    }

    /**
     * @param int $expireTime
     */
    public function setExpireTime(int $expireTime)
    {
        $this->expireTime = $expireTime;
    }
}
