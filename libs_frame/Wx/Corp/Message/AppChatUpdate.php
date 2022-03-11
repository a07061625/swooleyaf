<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/22 0022
 * Time: 11:05
 */

namespace Wx\Corp\Message;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 修改群聊会话
 *
 * @package Wx\Corp\Message
 */
class AppChatUpdate extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 群id
     *
     * @var string
     */
    private $chatid = '';
    /**
     * 群聊名
     *
     * @var string
     */
    private $name = '';
    /**
     * 群主id
     *
     * @var string
     */
    private $owner = '';
    /**
     * 添加成员列表
     *
     * @var array
     */
    private $add_user_list = [];
    /**
     * 踢出成员列表
     *
     * @var array
     */
    private $del_user_list = [];

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/appchat/update?access_token=';
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setChatId(string $chatId)
    {
        if (ctype_alnum($chatId) && (\strlen($chatId) <= 32)) {
            $this->reqData['chatid'] = $chatId;
        } else {
            throw new WxException('群id不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setName(string $name)
    {
        if (\strlen($name) > 0) {
            $this->reqData['name'] = mb_substr($name, 0, 25);
        } else {
            throw new WxException('群聊名不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setOwner(string $owner)
    {
        if (ctype_alnum($owner)) {
            $this->reqData['owner'] = $owner;
        } else {
            throw new WxException('群主id不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function setAddUserList(array $addUserList)
    {
        $users = [];
        foreach ($addUserList as $eAddUser) {
            if (ctype_alnum($eAddUser)) {
                $userId = strtolower($eAddUser);
                $users[$userId] = 1;
            }
        }

        if (empty($users)) {
            unset($this->reqData['add_user_list']);
        } else {
            $this->reqData['add_user_list'] = array_keys($users);
        }
    }

    public function setDelUserList(array $delUserList)
    {
        $users = [];
        foreach ($delUserList as $eDelUser) {
            if (ctype_alnum($eDelUser)) {
                $userId = strtolower($eDelUser);
                $users[$userId] = 1;
            }
        }

        if (empty($users)) {
            unset($this->reqData['del_user_list']);
        } else {
            $this->reqData['del_user_list'] = array_keys($users);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['chatid'])) {
            throw new WxException('群id不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . $this->getAccessToken(WxBaseCorp::ACCESS_TOKEN_TYPE_CORP, $this->_corpId, $this->_agentTag);
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
