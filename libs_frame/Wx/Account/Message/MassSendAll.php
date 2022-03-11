<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/22 0022
 * Time: 11:05
 */

namespace Wx\Account\Message;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseAccount;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class MassSendAll extends WxBaseAccount
{
    /**
     * 公众号ID
     *
     * @var string
     */
    private $appid = '';
    /**
     * 消息类型
     *
     * @var string
     */
    private $msgtype = '';
    /**
     * 接收者数据
     *
     * @var array
     */
    private $filter = [];
    /**
     * 群发消息ID
     *
     * @var string
     */
    private $clientmsgid = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=';
        $this->appid = $appId;
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setMsgData(string $type, array $data)
    {
        if (!isset(self::$totalMessageType[$type])) {
            throw new WxException('消息类型不支持', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($data['data'])) {
            throw new WxException('消息数据必须设置', ErrorCode::WX_PARAM_ERROR);
        }
        if (!\is_array($data['data'])) {
            throw new WxException('消息数据不合法', ErrorCode::WX_PARAM_ERROR);
        }
        if (empty($data['data'])) {
            throw new WxException('消息数据不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        if (self::MESSAGE_TYPE_MPNEWS == $type) {
            $ignoreReprint = isset($data['send_ignore_reprint']) && is_numeric($data['send_ignore_reprint']) ? (int)$data['send_ignore_reprint'] : 0;
            if (!\in_array($ignoreReprint, [0, 1], true)) {
                throw new WxException('转载群发标识不合法', ErrorCode::WX_PARAM_ERROR);
            }

            $this->reqData['send_ignore_reprint'] = $ignoreReprint;
        }

        $this->reqData['msgtype'] = $type;
        $this->reqData[$type] = $data['data'];
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setFilter(array $filter)
    {
        if (!isset($filter['is_to_all'])) {
            throw new WxException('接收者数据不合法', ErrorCode::WX_PARAM_ERROR);
        }
        if (!\is_bool($filter['is_to_all'])) {
            throw new WxException('接收者数据不合法', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($filter['tag_id'])) {
            throw new WxException('接收者数据不合法', ErrorCode::WX_PARAM_ERROR);
        }
        if (!\is_int($filter['tag_id'])) {
            throw new WxException('接收者数据不合法', ErrorCode::WX_PARAM_ERROR);
        }
        if ($filter['tag_id'] < 0) {
            throw new WxException('接收者数据不合法', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['filter'] = [
            'is_to_all' => $filter['is_to_all'],
            'tag_id' => $filter['tag_id'],
        ];
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setClientMsgId(string $clientMsgId)
    {
        if (ctype_alnum($clientMsgId) && (\strlen($clientMsgId) <= 64)) {
            $this->reqData['clientmsgid'] = $clientMsgId;
        } else {
            throw new WxException('群发消息ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['msgtype'])) {
            throw new WxException('消息类型不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['filter'])) {
            throw new WxException('接收者数据不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['clientmsgid'])) {
            throw new WxException('群发消息ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAccount::getAccessToken($this->appid);
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
