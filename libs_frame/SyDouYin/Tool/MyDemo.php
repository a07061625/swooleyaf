<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\Tool;

use SyDouYin\BaseTool;
use SyDouYin\Util;

/**
 * xxx
 *
 * @package SyDouYin\Tool
 */
class MyDemo extends BaseTool
{
    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceHost = Util::getServiceHost(Util::SERVICE_HOST_TYPE_DOUYIN);
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
