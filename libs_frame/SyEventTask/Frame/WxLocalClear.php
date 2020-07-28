<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/7/28 0028
 * Time: 10:49
 */
namespace SyEventTask\Frame;

use SyEventTask\TaskBase;
use SyServer\BaseServer;

/**
 * Class WxLocalClear
 *
 * @package SyEventTask\Frame
 */
class WxLocalClear extends TaskBase
{
    public function __construct()
    {
        parent::__construct();
        $this->intervalTime = 300000;
    }

    public function __clone()
    {
    }

    public function getData() : array
    {
        return [];
    }

    public function handle(array $data)
    {
        BaseServer::clearWxCache();
    }
}
