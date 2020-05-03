<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/14 0014
 * Time: 16:01
 */
namespace Wx\Merchant\PostageTemplate;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMerchant;
use Wx\WxUtilBase;
use Wx\WxUtilMerchant;

class TemplateDel extends WxBaseMerchant
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 模板ID
     * @var string
     */
    private $template_id = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/merchant/express/del?access_token=';
        $this->appid = $appId;
    }

    private function __clone()
    {
    }

    /**
     * @param string $templateId
     * @throws \SyException\Wx\WxException
     */
    public function setTemplateId(string $templateId)
    {
        if (ctype_alnum($templateId)) {
            $this->reqData['template_id'] = $templateId;
        } else {
            throw new WxException('模板ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['template_id'])) {
            throw new WxException('模板ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilMerchant::getAccessToken($this->appid);
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
