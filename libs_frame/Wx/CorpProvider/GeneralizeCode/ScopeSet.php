<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/23 0023
 * Time: 8:51
 */
namespace Wx\CorpProvider\GeneralizeCode;

use SyConstant\ErrorCode;
use SyException\Wx\WxCorpProviderException;
use SyTool\Tool;
use Wx\WxBaseCorpProvider;
use Wx\WxUtilBase;

/**
 * 设置授权应用可见范围
 * @package Wx\CorpProvider\GeneralizeCode
 */
class ScopeSet extends WxBaseCorpProvider
{
    /**
     * 令牌,由查询注册状态接口返回
     * @var string
     */
    private $access_token = '';
    /**
     * 应用ID
     * @var int
     */
    private $agentid = 0;
    /**
     * 应用成员可见范围
     * @var array
     */
    private $allow_user = [];
    /**
     * 应用部门可见范围
     * @var array
     */
    private $allow_party = [];
    /**
     * 应用标签可见范围
     * @var array
     */
    private $allow_tag = [];

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/agent/set_scope?access_token=';
    }

    private function __clone()
    {
    }

    /**
     * @param string $accessToken
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public function setAccessToken(string $accessToken)
    {
        if (strlen($accessToken) > 0) {
            $this->access_token = $accessToken;
        } else {
            throw new WxCorpProviderException('令牌不合法', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }
    }

    /**
     * @param int $agentId
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public function setAgentId(int $agentId)
    {
        if ($agentId > 0) {
            $this->reqData['agentid'] = $agentId;
        } else {
            throw new WxCorpProviderException('应用ID不合法', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }
    }

    /**
     * @param array $allowUser
     */
    public function setAllowUser(array $allowUser)
    {
        $userList = [];
        foreach ($allowUser as $eUser) {
            if (is_string($eUser) && (strlen($eUser) > 0)) {
                $userList[$eUser] = 1;
            }
        }

        if (empty($userList)) {
            unset($this->reqData['allow_user']);
        } else {
            $this->reqData['allow_user'] = array_keys($userList);
        }
    }

    /**
     * @param array $allowParty
     */
    public function setAllowParty(array $allowParty)
    {
        $partyList = [];
        foreach ($allowParty as $eParty) {
            if (is_int($eParty) && ($eParty > 0)) {
                $partyList[$eParty] = 1;
            }
        }

        if (empty($partyList)) {
            unset($this->reqData['allow_party']);
        } else {
            $this->reqData['allow_party'] = array_keys($partyList);
        }
    }

    /**
     * @param array $allowTag
     */
    public function setAllowTag(array $allowTag)
    {
        $tagList = [];
        foreach ($allowTag as $eTag) {
            if (is_int($eTag) && ($eTag > 0)) {
                $tagList[$eTag] = 1;
            }
        }

        if (empty($tagList)) {
            unset($this->reqData['allow_tag']);
        } else {
            $this->reqData['allow_tag'] = array_keys($tagList);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->access_token) == 0) {
            throw new WxCorpProviderException('令牌不能为空', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }
        if (!isset($this->reqData['agentid'])) {
            throw new WxCorpProviderException('应用ID不能为空', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . '?' . $this->access_token;
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
