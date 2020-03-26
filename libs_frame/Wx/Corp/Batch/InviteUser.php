<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/22 0022
 * Time: 11:05
 */
namespace Wx\Corp\Batch;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 邀请成员
 * @package Wx\Corp\Batch
 */
class InviteUser extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 用户ID列表
     * @var array
     */
    private $user = [];
    /**
     * 部门ID列表
     * @var array
     */
    private $party = [];
    /**
     * 标签ID列表
     * @var array
     */
    private $tag = [];

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/batch/invite?access_token=';
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['user'] = [];
        $this->reqData['party'] = [];
        $this->reqData['tag'] = [];
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
            if (ctype_alnum($eUserId)) {
                $userId = strtolower($eUserId);
                $users[$userId] = 1;
            }
        }

        $userNum = count($users);
        if ($userNum > 1000) {
            throw new WxException('用户ID列表不能超过1000个', ErrorCode::WX_PARAM_ERROR);
        } elseif ($userNum == 0) {
            throw new WxException('用户ID列表不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['user'] = array_keys($users);
    }

    /**
     * @param array $partyList
     * @throws \SyException\Wx\WxException
     */
    public function setPartyList(array $partyList)
    {
        $party = [];
        foreach ($partyList as $eParty) {
            if (is_int($eParty) && ($eParty > 0)) {
                $party[$eParty] = 1;
            }
        }

        if (count($party) > 100) {
            throw new WxException('部门ID列表不能超过1000个', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['party'] = array_keys($party);
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
            throw new WxException('标签ID列表不能超过1000个', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['tag'] = array_keys($tags);
    }

    public function getDetail() : array
    {
        if (empty($this->reqData['user']) && empty($this->reqData['party']) && empty($this->reqData['tag'])) {
            throw new WxException('用户列表,部门列表和标签列表不能同时为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
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
