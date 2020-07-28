<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/7/28 0028
 * Time: 10:11
 */
namespace SyEventTask\Frame;

use SyConstant\SyInner;
use SyEventTask\TaskBase;
use SyServer\HttpServer;

/**
 * Class TokenRefresh
 *
 * @package SyEventTask\Frame
 */
class TokenRefresh extends TaskBase
{
    public function __construct()
    {
        parent::__construct();
        $this->supportServerTypes[SyInner::SERVER_TYPE_API_GATE] = 1;
        $this->supportServerTypes[SyInner::SERVER_TYPE_FRONT_GATE] = 1;
        $this->intervalTime = 540000;
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
        HttpServer::refreshServerTokenExpireTime();
    }
}
