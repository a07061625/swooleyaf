<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 17:32
 */

namespace Wx\Open;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyTool\Tool;
use Wx\WxBaseOpen;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

/**
 * 解绑应用
 *
 * @package Wx\Open
 */
class AppUnbind extends WxBaseOpen
{
    /**
     * 公众号或小程序的app id
     *
     * @var string
     */
    private $appid = '';
    /**
     * 开放平台的app id
     *
     * @var string
     */
    private $open_appid = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/open/unbind?access_token=';
        $this->reqData['appid'] = $appId;
        $this->reqData['open_appid'] = WxConfigSingleton::getInstance()->getOpenCommonConfig()->getAppId();
    }

    public function __clone()
    {
        //do nothing
    }

    public function getDetail(): array
    {
        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getComponentAccessToken($this->reqData['open_appid']);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
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
