<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-31
 * Time: 下午3:51
 */
namespace DingDing\Corp\MicroApp;

use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyTool\Tool;

/**
 * 获取应用列表
 * @package DingDing\Corp\MicroApp
 */
class AppList extends TalkBaseCorp
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
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/microapp/list?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode([], JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
