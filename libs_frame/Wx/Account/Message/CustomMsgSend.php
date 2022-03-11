<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-12
 * Time: 下午11:14
 */

namespace Wx\Account\Message;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseAccount;
use Wx\WxUtilAlone;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class CustomMsgSend extends WxBaseAccount
{
    const CUSTOM_MSG_TYPE_TEXT = 'text';
    const CUSTOM_MSG_TYPE_IMAGE = 'image';
    const CUSTOM_MSG_TYPE_VOICE = 'voice';
    const CUSTOM_MSG_TYPE_VIDEO = 'video';
    const CUSTOM_MSG_TYPE_MUSIC = 'music';
    const CUSTOM_MSG_TYPE_NEWS = 'news';
    const CUSTOM_MSG_TYPE_MPNEWS = 'mpnews';
    const CUSTOM_MSG_TYPE_MENU = 'msgmenu';

    private static $totalCustomMsgType = [
        self::CUSTOM_MSG_TYPE_TEXT => '文本',
        self::CUSTOM_MSG_TYPE_IMAGE => '图片',
        self::CUSTOM_MSG_TYPE_VOICE => '语音',
        self::CUSTOM_MSG_TYPE_VIDEO => '视频',
        self::CUSTOM_MSG_TYPE_MUSIC => '音乐',
        self::CUSTOM_MSG_TYPE_NEWS => '图文(跳转到外链)',
        self::CUSTOM_MSG_TYPE_MPNEWS => '图文(跳转到图文消息页面)',
        self::CUSTOM_MSG_TYPE_MENU => '菜单',
    ];

    /**
     * 应用ID
     *
     * @var string
     */
    private $appId = '';
    /**
     * 令牌
     *
     * @var string
     */
    private $accessToken = '';
    /**
     * 用户openid
     *
     * @var string
     */
    private $touser = '';
    /**
     * 消息类型
     *
     * @var string
     */
    private $msgType = '';
    /**
     * 消息数据
     *
     * @var array
     */
    private $msgData = [];
    /**
     * 平台类型
     *
     * @var string
     */
    private $platType = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=';
        $this->platType = WxUtilBase::PLAT_TYPE_SHOP;
        $this->appId = $appId;
    }

    public function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setAccessToken(string $accessToken)
    {
        if (\strlen($accessToken) > 0) {
            $this->accessToken = $accessToken;
        } else {
            throw new WxException('令牌不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setOpenid(string $openid)
    {
        if (preg_match(ProjectBase::REGEX_WX_OPEN_ID, $openid) > 0) {
            $this->reqData['touser'] = $openid;
        } else {
            throw new WxException('用户openid不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
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
     * @throws \SyException\Wx\WxException
     */
    public function setPlatType(string $platType)
    {
        if (\in_array($platType, [WxUtilBase::PLAT_TYPE_SHOP, WxUtilBase::PLAT_TYPE_OPEN_SHOP], true)) {
            $this->platType = $platType;
        } else {
            throw new WxException('平台类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
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

        if (\strlen($this->accessToken) > 0) {
            $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . $this->accessToken;
        } elseif (WxUtilBase::PLAT_TYPE_SHOP == $this->platType) {
            $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAlone::getAccessToken($this->appId);
        } else {
            $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getAuthorizerAccessToken($this->appId);
        }
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [
            'Expect:',
        ];
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (0 == $sendData['errcode']) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXOPEN_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
