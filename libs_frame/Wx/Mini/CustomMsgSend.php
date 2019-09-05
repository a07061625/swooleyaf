<?php
/**
 * 发送客服消息给用户
 * User: 姜伟
 * Date: 18-9-12
 * Time: 下午11:14
 */
namespace Wx\Mini;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseMini;
use Wx\WxUtilBase;
use Wx\WxUtilBaseAlone;
use Wx\WxUtilOpenBase;

class CustomMsgSend extends WxBaseMini
{
    const CUSTOM_MSG_TYPE_TEXT = 'text';
    const CUSTOM_MSG_TYPE_IMAGE = 'image';
    const CUSTOM_MSG_TYPE_LINK = 'link';
    const CUSTOM_MSG_TYPE_PROGRAM_PAGE = 'miniprogrampage';

    private static $totalCustomMsgType = [
        self::CUSTOM_MSG_TYPE_TEXT => '文本',
        self::CUSTOM_MSG_TYPE_IMAGE => '图片',
        self::CUSTOM_MSG_TYPE_LINK => '图文链接',
        self::CUSTOM_MSG_TYPE_PROGRAM_PAGE => '小程序卡片',
    ];

    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 令牌
     * @var string
     */
    private $accessToken = '';
    /**
     * 用户openid
     * @var string
     */
    private $touser = '';
    /**
     * 消息类型
     * @var string
     */
    private $msgType = '';
    /**
     * 消息数据
     * @var array
     */
    private $msgData = [];
    /**
     * 平台类型
     * @var string
     */
    private $platType = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=';
        $this->platType = WxUtilBase::PLAT_TYPE_MINI;
        $this->appId = $appId;
    }

    public function __clone()
    {
    }

    /**
     * @param string $openid
     * @throws \SyException\Wx\WxException
     */
    public function setOpenid(string $openid)
    {
        if (preg_match('/^[0-9a-zA-Z\-\_]{28}$/', $openid) > 0) {
            $this->reqData['touser'] = $openid;
        } else {
            throw new WxException('用户openid不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $msgType
     * @param array $msgData
     * @throws \SyException\Wx\WxException
     */
    public function setMsgInfo(string $msgType, array $msgData)
    {
        if (!isset(self::$totalCustomMsgType[$msgType])) {
            throw new WxException('消息类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
        if (empty($msgData)) {
            throw new WxException('消息数据不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['msgtype'] = $msgType;
        $this->reqData[$msgType] = $msgData;
    }

    /**
     * @param string $platType
     * @throws \SyException\Wx\WxException
     */
    public function setPlatType(string $platType)
    {
        if (in_array($platType, [WxUtilBase::PLAT_TYPE_MINI, WxUtilBase::PLAT_TYPE_OPEN_MINI], true)) {
            $this->platType = $platType;
        } else {
            throw new WxException('平台类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['touser'])) {
            throw new WxException('用户openid不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['msgtype'])) {
            throw new WxException('消息类型不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        if ($this->platType == WxUtilBase::PLAT_TYPE_MINI) {
            $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilBaseAlone::getAccessToken($this->appId);
        } else {
            $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getAuthorizerAccessToken($this->appId);
        }
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [
            'Expect:',
        ];
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXOPEN_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
