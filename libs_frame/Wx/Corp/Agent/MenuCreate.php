<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/24 0024
 * Time: 16:29
 */
namespace Wx\Corp\Agent;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 创建菜单
 * @package Wx\Corp\Agent
 */
class MenuCreate extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 应用ID
     * @var string
     */
    private $agentid = '';
    /**
     * 菜单列表
     * @var array
     */
    private $button = [];

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/menu/create';
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $agentInfo = WxConfigSingleton::getInstance()->getCorpConfig($corpId)->getAgentInfo($agentTag);
        $this->agentid = $agentInfo['id'];
        $this->reqData['button'] = [];
    }

    private function __clone()
    {
    }

    /**
     * @param array $buttonInfo
     * @throws \SyException\Wx\WxException
     */
    public function addButton(array $buttonInfo)
    {
        if (empty($buttonInfo)) {
            throw new WxException('菜单信息不合法', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['button'][] = $buttonInfo;
    }

    public function getDetail() : array
    {
        if (empty($this->reqData['button'])) {
            throw new WxException('菜单列表不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . '?' . http_build_query([
            'agentid' => $this->agentid,
            'access_token' => $this->getAccessToken(WxBaseCorp::ACCESS_TOKEN_TYPE_CORP, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
