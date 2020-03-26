<?php
/**
 * 删除指定小程序代码模版
 * User: 姜伟
 * Date: 18-9-13
 * Time: 上午12:09
 */
namespace Wx\OpenMini\CodeTemplate;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxOpenException;
use SyTool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class TemplateCodeDelete extends WxBaseOpenMini
{
    /**
     * 模板ID
     * @var string
     */
    private $templateId = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxa/deletetemplate?access_token=';
    }

    public function __clone()
    {
    }

    /**
     * @param string $templateId
     * @throws \SyException\Wx\WxOpenException
     */
    public function setTemplateId(string $templateId)
    {
        if (strlen($templateId) > 0) {
            $this->reqData['template_id'] = $templateId;
        } else {
            throw new WxOpenException('模板ID不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['template_id'])) {
            throw new WxOpenException('模板ID不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getComponentAccessToken(WxConfigSingleton::getInstance()->getOpenCommonConfig()->getAppId());
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
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
