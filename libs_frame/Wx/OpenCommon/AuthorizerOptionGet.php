<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-12
 * Time: 下午10:47
 */
namespace Wx\OpenCommon;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxOpenException;
use Tool\Tool;
use Wx\WxBaseOpenCommon;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class AuthorizerOptionGet extends WxBaseOpenCommon
{
    /**
     * 第三方平台appid
     * @var string
     */
    private $component_appid = '';
    /**
     * 授权公众号或小程序的appid
     * @var string
     */
    private $authorizer_appid = '';
    /**
     * 选项名称
     * @var string
     */
    private $option_name = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/component/api_get_authorizer_option?component_access_token=';
        $this->reqData['component_appid'] = WxConfigSingleton::getInstance()->getOpenCommonConfig()->getAppId();
        $this->reqData['authorizer_appid'] = $appId;
    }

    public function __clone()
    {
    }

    /**
     * @param string $optionName
     * @throws \SyException\Wx\WxOpenException
     */
    public function setOptionName(string $optionName)
    {
        if (strlen($optionName) > 0) {
            $this->reqData['option_name'] = $optionName;
        } else {
            throw new WxOpenException('选项名称不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['option_name'])) {
            throw new WxOpenException('选项名称不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getComponentAccessToken($this->reqData['component_appid']);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['authorizer_appid'])) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXOPEN_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
