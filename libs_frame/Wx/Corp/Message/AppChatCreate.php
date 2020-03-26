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
 * 创建群聊会话
 * @package Wx\Corp\Message
 */
class AppChatCreate extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 群聊名
     * @var string
     */
    private $name = '';
    /**
     * 群主id
     * @var string
     */
    private $owner = '';
    /**
     * 群成员列表
     * @var array
     */
    private $userlist = [];
    /**
     * 群id
     * @var string
     */
    private $chatid = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/appchat/create?access_token=';
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['chatid'] = Tool::createNonceStr('8', 'numlower') . Tool::getNowTime();
    }

    private function __clone()
    {
    }

    /**
     * @param string $name
     * @throws \SyException\Wx\WxException
     */
    public function setName(string $name)
    {
        if (strlen($name) > 0) {
            $this->reqData['name'] = mb_substr($name, 0, 25);
        } else {
            throw new WxException('群聊名不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $owner
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
        if ($userNum < 2) {
            throw new WxException('群成员不能少于2个', ErrorCode::WX_PARAM_ERROR);
        } elseif ($userNum > 500) {
            throw new WxException('群成员不能超过500个', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['userlist'] = array_keys($users);
    }

    /**
     * @param string $chatId
     * @throws \SyException\Wx\WxException
     */
    public function setChatId(string $chatId)
    {
        if (ctype_alnum($chatId) && (strlen($chatId) <= 32)) {
            $this->reqData['chatid'] = $chatId;
        } else {
            throw new WxException('群id不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['name'])) {
            throw new WxException('群聊名不能为空', ErrorCode::WX_PARAM_ERROR);
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
