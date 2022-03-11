<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 10:39
 */

namespace Wx\Alone;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseAlone;
use Wx\WxUtilBase;

class JsTicket extends WxBaseAlone
{
    /**
     * 令牌
     *
     * @var string
     */
    private $accessToken = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket';
        $this->reqData['type'] = 'jsapi';
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
            $this->reqData['access_token'] = $accessToken;
        } else {
            throw new WxException('令牌不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setType(string $type)
    {
        if (\in_array($type, ['jsapi', 'wx_card'])) {
            $this->reqData['type'] = $type;
        } else {
            throw new WxException('类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['access_token'])) {
            throw new WxException('令牌不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . '?' . http_build_query($this->reqData);
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (!\is_array($sendData)) {
            throw new WxException('获取ticket出错', ErrorCode::WX_PARAM_ERROR);
        }
        if ($sendData['errcode'] > 0) {
            throw new WxException($sendData['errmsg'], ErrorCode::WX_PARAM_ERROR);
        }

        return $sendData;
    }
}
