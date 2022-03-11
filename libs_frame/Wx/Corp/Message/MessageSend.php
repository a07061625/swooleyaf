<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/22 0022
 * Time: 11:05
 */

namespace Wx\Corp\Message;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 发送企业消息
 *
 * @package Wx\Corp\Message
 */
class MessageSend extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 成员ID列表
     *
     * @var array
     */
    private $touser = [];
    /**
     * 部门ID列表
     *
     * @var array
     */
    private $toparty = [];
    /**
     * 标签ID列表
     *
     * @var array
     */
    private $totag = [];
    /**
     * 消息类型
     *
     * @var string
     */
    private $msgtype = '';
    /**
     * 应用id
     *
     * @var string
     */
    private $agentid = '';
    /**
     * 保密消息标识,默认0 0:否 1:是
     *
     * @var int
     */
    private $safe = 0;

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token=';
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $agentInfo = WxConfigSingleton::getInstance()->getCorpConfig($corpId)->getAgentInfo($agentTag);
        $this->reqData['agentid'] = $agentInfo['id'];
        $this->reqData['safe'] = 0;
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @param array|string $userList
     *
     * @throws \SyException\Wx\WxException
     */
    public function setUserList($userList)
    {
        if (\is_string($userList)) {
            if ('@all' == $userList) {
                $this->reqData['touser'] = '@all';
            } else {
                throw new WxException('成员ID列表不合法', ErrorCode::WX_PARAM_ERROR);
            }
        } elseif (\is_array($userList)) {
            $users = [];
            foreach ($userList as $eUserId) {
                if (ctype_alnum($eUserId)) {
                    $userId = strtolower($eUserId);
                    $users[$userId] = 1;
                }
            }
            if (\count($users) > 1000) {
                throw new WxException('成员ID不能超过1000个', ErrorCode::WX_PARAM_ERROR);
            }
            $this->reqData['touser'] = implode('|', array_keys($users));
        } else {
            throw new WxException('成员ID列表不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setPartyList(array $partyList)
    {
        $party = [];
        foreach ($partyList as $eParty) {
            if (\is_int($eParty) && ($eParty > 0)) {
                $party[$eParty] = 1;
            }
        }
        if (\count($party) > 100) {
            throw new WxException('部门ID不能超过100个', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['toparty'] = implode('|', array_keys($party));
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setTagList(array $tagList)
    {
        $tags = [];
        foreach ($tagList as $eTag) {
            if (\is_int($eTag) && ($eTag > 0)) {
                $tags[$eTag] = 1;
            }
        }
        if (\count($tags) > 100) {
            throw new WxException('标签ID不能超过100个', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['totag'] = implode('|', array_keys($tags));
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setMsgData(string $type, array $data)
    {
        if (!isset(self::$totalMessageType[$type])) {
            throw new WxException('消息类型不支持', ErrorCode::WX_PARAM_ERROR);
        }
        if (empty($data)) {
            throw new WxException('消息数据不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['msgtype'] = $type;
        $this->reqData[$type] = $data;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setSafe(int $safe)
    {
        if (\in_array($safe, [0, 1], true)) {
            $this->reqData['safe'] = $safe;
        } else {
            throw new WxException('保密消息标识不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['msgtype'])) {
            throw new WxException('消息类型不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (0 == $sendData['errcode']) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
