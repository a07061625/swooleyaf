<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/22 0022
 * Time: 11:05
 */
namespace Wx\Corp\Message;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 发送互联企业消息
 * @package Wx\Corp\Message
 */
class LinkedCorpMessageSend extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 成员ID列表
     * @var array
     */
    private $touser = [];
    /**
     * 部门ID列表
     * @var array
     */
    private $toparty = [];
    /**
     * 标签ID列表
     * @var array
     */
    private $totag = [];
    /**
     * 发送消息标识,默认0 0:不发送给应用可见范围内的所有人 1:发送给应用可见范围内的所有人
     * @var int
     */
    private $toall = 0;
    /**
     * 消息类型
     * @var string
     */
    private $msgtype = '';
    /**
     * 应用id
     * @var string
     */
    private $agentid = '';
    /**
     * 保密消息标识,默认0 0:否 1:是
     * @var int
     */
    private $safe = 0;

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/linkedcorp/message/send?access_token=';
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $agentInfo = WxConfigSingleton::getInstance()->getCorpConfig($corpId)->getAgentInfo($agentTag);
        $this->reqData['agentid'] = $agentInfo['id'];
        $this->reqData['toall'] = 0;
        $this->reqData['safe'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @param array $userList
     * @throws \SyException\Wx\WxException
     */
    public function setUserList(array $userList)
    {
        $users = [];
        foreach ($userList as $eUserId) {
            if (is_string($eUserId) && (strlen($eUserId) > 0)) {
                $userId = strtolower($eUserId);
                $users[$userId] = 1;
            }
        }
        if (count($users) > 1000) {
            throw new WxException('成员ID不能超过1000个', ErrorCode::WX_PARAM_ERROR);
        } else {
            $this->reqData['touser'] = array_keys($users);
        }
    }

    /**
     * @param array $partyList
     * @throws \SyException\Wx\WxException
     */
    public function setPartyList(array $partyList)
    {
        $party = [];
        foreach ($partyList as $eParty) {
            if (is_string($eParty) && (strlen($eParty) > 0)) {
                $party[$eParty] = 1;
            }
        }
        if (count($party) > 100) {
            throw new WxException('部门ID不能超过100个', ErrorCode::WX_PARAM_ERROR);
        } else {
            $this->reqData['toparty'] = array_keys($party);
        }
    }

    /**
     * @param array $tagList
     * @throws \SyException\Wx\WxException
     */
    public function setTagList(array $tagList)
    {
        $tags = [];
        foreach ($tagList as $eTag) {
            if (is_int($eTag) && ($eTag > 0)) {
                $tags[$eTag] = 1;
            }
        }
        if (count($tags) > 100) {
            throw new WxException('标签ID不能超过100个', ErrorCode::WX_PARAM_ERROR);
        } else {
            $this->reqData['totag'] = array_keys($tags);
        }
    }

    /**
     * @param int $sendAllFlag
     * @throws \SyException\Wx\WxException
     */
    public function setSendAllFlag(int $sendAllFlag)
    {
        if (in_array($sendAllFlag, [0, 1], true)) {
            $this->reqData['toall'] = $sendAllFlag;
        } else {
            throw new WxException('发送消息标识不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $type
     * @param array $data
     * @throws \SyException\Wx\WxException
     */
    public function setMsgData(string $type, array $data)
    {
        if (!isset(self::$totalMessageType[$type])) {
            throw new WxException('消息类型不支持', ErrorCode::WX_PARAM_ERROR);
        } elseif (empty($data)) {
            throw new WxException('消息数据不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['msgtype'] = $type;
        $this->reqData[$type] = $data;
    }

    /**
     * @param int $safe
     * @throws \SyException\Wx\WxException
     */
    public function setSafe(int $safe)
    {
        if (in_array($safe, [0, 1], true)) {
            $this->reqData['safe'] = $safe;
        } else {
            throw new WxException('保密消息标识不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['msgtype'])) {
            throw new WxException('消息类型不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . $this->getAccessToken(WxBaseCorp::ACCESS_TOKEN_TYPE_CORP, $this->_corpId, $this->_agentTag);
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
