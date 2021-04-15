<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\LifeService;

use SyDouYin\BaseLifeService;
use SyDouYin\Util;

/**
 * xxx
 *
 * @package SyDouYin\LifeService
 */
class MyDemo extends BaseLifeService
{
    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceHost = Util::SERVICE_HOST_TYPE_DOUYIN;
        $this->serviceUri = '/xxx';
    }

    private function __clone()
    {
    }

    public function getDetail(): array
    {
        $this->getContent();

        return $this->curlConfigs;
    }
}
