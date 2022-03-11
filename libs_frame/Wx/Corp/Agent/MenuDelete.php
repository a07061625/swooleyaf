<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/24 0024
 * Time: 16:29
 */

namespace Wx\Corp\Agent;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 删除菜单
 *
 * @package Wx\Corp\Agent
 */
class MenuDelete extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 应用ID
     *
     * @var string
     */
    private $agentid = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/menu/delete';
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $agentInfo = WxConfigSingleton::getInstance()->getCorpConfig($corpId)->getAgentInfo($agentTag);
        $this->reqData['agentid'] = $agentInfo['id'];
    }

    private function __clone()
    {
        //do nothing
    }

    public function getDetail(): array
    {
        $resArr = [
            'code' => 0,
        ];

        $this->reqData['access_token'] = $this->getAccessToken(WxBaseCorp::ACCESS_TOKEN_TYPE_CORP, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . '?' . http_build_query($this->reqData);
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (0 == $sendData['errcode']) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_GET_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
