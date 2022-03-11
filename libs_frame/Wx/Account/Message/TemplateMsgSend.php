<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-12
 * Time: 上午12:07
 */

namespace Wx\Account\Message;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseAccount;
use Wx\WxUtilAlone;
use Wx\WxUtilBase;

class TemplateMsgSend extends WxBaseAccount
{
    /**
     * 公众号ID
     *
     * @var string
     */
    private $appid = '';
    /**
     * 用户openid
     *
     * @var string
     */
    private $openid = '';
    /**
     * 模版ID
     *
     * @var string
     */
    private $template_id = '';
    /**
     * 重定向链接地址
     *
     * @var string
     */
    private $redirect_url = '';
    /**
     * 小程序跳转数据
     *
     * @var array
     */
    private $miniprogram = [];
    /**
     * 模版数据
     *
     * @var array
     */
    private $template_data = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=';
        $this->appid = $appId;
        $this->reqData['url'] = '';
        $this->reqData['data'] = [];
    }

    public function __clone()
    {
        //do nothing
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
            throw new WxException('模版ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setRedirectUrl(string $redirectUrl)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $redirectUrl) > 0) {
            $this->reqData['url'] = $redirectUrl;
        } else {
            throw new WxException('重定向链接不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setMiniProgram(array $miniProgram)
    {
        if (empty($miniProgram)) {
            throw new WxException('小程序跳转数据不合法', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['miniprogram'] = $miniProgram;
    }

    /**
     * 模板参数内容
     * 数据格式如下:
     * [
     *     'first' => [
     *         'value' => '1234',
     *         'color' => '#743A3A',
     *     ],
     *     'remark' => [
     *         'value' => '1234',
     *         'color' => '#743A3A',
     *     ],
     * ]
     */
    public function setTemplateData(array $templateData)
    {
        $this->reqData['data'] = $templateData;
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['touser'])) {
            throw new WxException('用户openid不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['template_id'])) {
            throw new WxException('模版ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAlone::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
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
