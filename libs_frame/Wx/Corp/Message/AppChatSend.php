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
 * 发送群聊会话消息
 * @package Wx\Corp\Message
 */
class AppChatSend extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 群id
     * @var string
     */
    private $chatid = '';
    /**
     * 消息类型
     * @var string
     */
    private $msgtype = '';
    /**
     * 保密消息标识,默认0 0:否 1:是
     * @var int
     */
    private $safe = 0;

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/appchat/send?access_token=';
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['safe'] = 0;
    }

    private function __clone()
    {
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

    /**
     * @param string $type
     * @param array $data
     * @throws \SyException\Wx\WxException
     */
    public function setMsgData(string $type, array $data)
    {
        if (!isset(self::$totalMessageType[$type])) {
            throw new WxException('消息类型不支持', ErrorCode::WX_PARAM_ERROR);
        } elseif ($type == WxBaseCorp::MESSAGE_TYPE_MINI_NOTICE) {
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
        if (!isset($this->reqData['chatid'])) {
            throw new WxException('群id不能为空', ErrorCode::WX_PARAM_ERROR);
        }
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
