<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-3-8
 * Time: 下午8:45
 */
namespace SyException\MemCache;

use SyException\BaseException;

class MemCacheException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = 'MEMCACHE异常';
    }
}
