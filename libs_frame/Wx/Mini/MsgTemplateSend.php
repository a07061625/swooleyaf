<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-12
 * Time: 下午7:20
 */

namespace Wx\Mini;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMini;
use Wx\WxUtilAlone;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class MsgTemplateSend extends WxBaseMini
{
    /**
     * 应用ID
     *
     * @var string
     */
    private $appId = '';
    /**
     * 用户openid
     *
     * @var string
     */
    private $openid = '';
    /**
     * 模板ID
     *
     * @var string
     */
    private $templateId = '';
    /**
     * 跳转页面
     *
     * @var string
     */
    private $redirectUrl = '';
    /**
     * 表单ID
     *
     * @var string
     */
    private $formId = '';
    /**
     * 模板内容
     *
     * @var array
     */
    private $data = [];
    /**
     * 放大的关键词
     *
     * @var string
     */
    private $emphasisKeyword = '';
    /**
     * 平台类型
     *
     * @var string
     */
    private $platType = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token=';
        $this->appId = $appId;
        $this->platType = WxUtilBase::PLAT_TYPE_MINI;
        $this->reqData['data'] = [];
        $this->reqData['page'] = '';
    }

    public function __clone()
    {
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
    public function setTemplateId(string $templateId)
    {
        if (\strlen($templateId) > 0) {
            $this->reqData['template_id'] = $templateId;
        } else {
            throw new WxException('模板ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setRedirectUrl(string $redirectUrl)
    {
        if (\strlen($redirectUrl) > 0) {
            $this->reqData['page'] = $redirectUrl;
        } else {
            throw new WxException('跳转页面不能为空', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setFormId(string $formId)
    {
        if (\strlen($formId) > 0) {
            $this->reqData['form_id'] = $formId;
        } else {
            throw new WxException('表单ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function setData(array $data)
    {
        $this->reqData['data'] = $data;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setEmphasisKeyword(string $emphasisKeyword)
    {
        if (\strlen($emphasisKeyword) > 0) {
            $this->reqData['emphasis_keyword'] = $emphasisKeyword;
        } else {
            throw new WxException('关键词不能为空', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setPlatType(string $platType)
    {
        if (\in_array($platType, [WxUtilBase::PLAT_TYPE_MINI, WxUtilBase::PLAT_TYPE_OPEN_MINI], true)) {
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
        if (!isset($this->reqData['template_id'])) {
            throw new WxException('模板ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['form_id'])) {
            throw new WxException('表单ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        if (WxUtilBase::PLAT_TYPE_MINI == $this->platType) {
            $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAlone::getAccessToken($this->appId);
        } else {
            $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getAuthorizerAccessToken($this->appId);
        }
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
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
