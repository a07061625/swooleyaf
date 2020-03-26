<?php
namespace Wx\CorpProvider\Common;

use SyConstant\ErrorCode;
use SyException\Wx\WxCorpProviderException;
use SyTool\Tool;
use Wx\WxBaseCorpProvider;
use Wx\WxUtilBase;
use Wx\WxUtilCorpProvider;

/**
 * 获取应用的管理员列表
 * @package Wx\CorpProvider\Common
 */
class AdminListGet extends WxBaseCorpProvider
{
    /**
     * 授权企业ID
     * @var string
     */
    private $auth_corpid = '';
    /**
     * 应用ID
     * @var string
     */
    private $agentid = '';

    public function __construct(string $corpId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/service/get_admin_list?suite_access_token=';
        $this->reqData['auth_corpid'] = $corpId;
    }

    private function __clone()
    {
    }

    /**
     * @param string $agentId
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public function setAgentId(string $agentId)
    {
        if (ctype_alnum($agentId)) {
            $this->reqData['agentid'] = $agentId;
        } else {
            throw new WxCorpProviderException('应用ID不合法', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['agentid'])) {
            throw new WxCorpProviderException('应用ID不能为空', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . '?' . WxUtilCorpProvider::getSuiteToken();
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXPROVIDER_CORP_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
