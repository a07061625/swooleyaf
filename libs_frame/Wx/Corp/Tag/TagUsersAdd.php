<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/22 0022
 * Time: 11:05
 */
namespace Wx\Corp\Tag;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 增加标签成员
 * @package Wx\Corp\Tag
 */
class TagUsersAdd extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 标签id
     * @var int
     */
    private $tagid = 0;
    /**
     * 成员ID列表
     * @var array
     */
    private $userlist = [];
    /**
     * 部门ID列表
     * @var array
     */
    private $partylist = [];

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/tag/addtagusers?access_token=';
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['userlist'] = [];
        $this->reqData['partylist'] = [];
    }

    private function __clone()
    {
    }

    /**
     * @param int $tagId
     * @throws \SyException\Wx\WxException
     */
    public function setTagId(int $tagId)
    {
        if ($tagId > 0) {
            $this->reqData['tagid'] = $tagId;
        } else {
            throw new WxException('标签id不合法', ErrorCode::WX_PARAM_ERROR);
        }
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
            throw new WxException('成员ID列表不能超过1000个', ErrorCode::WX_PARAM_ERROR);
        } elseif ($userNum == 0) {
            throw new WxException('成员ID列表不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['userlist'] = array_keys($users);
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

        $this->reqData['partylist'] = array_keys($party);
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['tagid'])) {
            throw new WxException('标签id不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (empty($this->reqData['userlist']) && empty($this->reqData['partylist'])) {
            throw new WxException('成员列表和部门列表不能同时为空', ErrorCode::WX_PARAM_ERROR);
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
