<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\Enterprise;

use SyDouYin\BaseEnterprise;

/**
 * xxx
 *
 * @package SyDouYin\Enterprise
 */
class MyDemo extends BaseEnterprise
{
    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
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
