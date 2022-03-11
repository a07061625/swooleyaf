<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-12
 * Time: 下午10:47
 */

namespace Wx\OpenCommon;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Wx\WxOpenException;
use SyTool\Tool;
use Wx\WxBaseOpenCommon;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class AuthorizerOptionSet extends WxBaseOpenCommon
{
    /**
     * 第三方平台appid
     *
     * @var string
     */
    private $component_appid = '';
    /**
     * 授权公众号或小程序的appid
     *
     * @var string
     */
    private $authorizer_appid = '';
    /**
     * 选项名称
     *
     * @var string
     */
    private $option_name = '';
    /**
     * 选项值
     *
     * @var string
     */
    private $option_value = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/component/api_set_authorizer_option?component_access_token=';
        $this->reqData['component_appid'] = WxConfigSingleton::getInstance()->getOpenCommonConfig()->getAppId();
        $this->reqData['authorizer_appid'] = $appId;
    }

    public function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setOptionName(string $optionName)
    {
        if (\strlen($optionName) > 0) {
            $this->reqData['option_name'] = $optionName;
        } else {
            throw new WxOpenException('选项名称不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setOptionValue(string $optionValue)
    {
        if (\strlen($optionValue) > 0) {
            $this->reqData['option_value'] = $optionValue;
        } else {
            throw new WxOpenException('选项值不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['option_name'])) {
            throw new WxOpenException('选项名称不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        if (!isset($this->reqData['option_value'])) {
            throw new WxOpenException('选项值不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getComponentAccessToken($this->reqData['component_appid']);
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
