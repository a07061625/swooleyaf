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
 * 获取jsapi_ticket
 *
 * @package SyDouYin\Tool
 */
class JsApiTicket extends BaseTool
{
    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/js/getticket/';
    }

    private function __clone()
    {
    }

    public function getDetail(): array
    {
        $this->serviceUri .= '?' . http_build_query([
            'access_token' => Util::getClientToken($this->clientKey, $this->serviceHostType),
        ]);
        $this->getContent();

        return $this->curlConfigs;
    }
}
