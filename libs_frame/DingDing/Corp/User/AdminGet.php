<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-28
 * Time: 上午11:15
 */
namespace DingDing\Corp\User;

use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;

/**
 * 获取管理员列表
 * @package DingDing\Corp\User
 */
class AdminGet extends TalkBaseCorp
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
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/user/get_admin?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        return $this->sendRequest('GET');
    }
}
