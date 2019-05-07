<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-7
 * Time: 下午6:13
 */
namespace DingDing\Corp\Auth;

use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;

/**
 * 获取通讯录权限范围
 * @package DingDing\Corp\Auth
 */
class Scopes extends TalkBaseCorp
{
    use TalkTraitCorp;

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        $this->reqData['access_token'] = $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/auth/scopes?' . http_build_query($this->reqData);
        return $this->sendRequest('GET');
    }
}
