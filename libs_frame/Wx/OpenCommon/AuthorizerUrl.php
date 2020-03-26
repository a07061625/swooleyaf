<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-12
 * Time: 下午10:25
 */
namespace Wx\OpenCommon;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyLog\Log;
use SyTool\Tool;
use Wx\WxBaseOpenCommon;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class AuthorizerUrl extends WxBaseOpenCommon
{
    /**
     * @var string
     */
    private $urlPreAuth = '';
    private $urlAuthCallback = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/component/api_create_preauthcode?component_access_token=';
        $this->urlPreAuth = 'https://mp.weixin.qq.com/cgi-bin/componentloginpage';
        $openCommonConfig = WxConfigSingleton::getInstance()->getOpenCommonConfig();
        $this->reqData['component_appid'] = $openCommonConfig->getAppId();
        $this->urlAuthCallback = $openCommonConfig->getUrlAuthCallback();
    }

    public function __clone()
    {
    }

    public function getDetail() : array
    {
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getComponentAccessToken($this->reqData['component_appid']);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['pre_auth_code'])) {
            return [
                'url' => $this->urlPreAuth . '?' . http_build_query([
                    'component_appid' => $this->reqData['component_appid'],
                    'pre_auth_code' => $sendData['pre_auth_code'],
                    'redirect_uri' => $this->urlAuthCallback,
                ]),
            ];
        } else {
            Log::error('wxopen get auth url error:' . $sendRes, ErrorCode::WXOPEN_POST_ERROR);
            return [
                'url' => '',
            ];
        }
    }
}
