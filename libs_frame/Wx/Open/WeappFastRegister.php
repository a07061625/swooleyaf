<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 17:32
 */
namespace Wx\Open;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxOpenException;
use SyTool\Tool;
use Wx\WxBaseOpen;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

/**
 * 第三方平台创建小程序
 * @package Wx\Open
 */
class WeappFastRegister extends WxBaseOpen
{
    /**
     * 企业名
     * @var string
     */
    private $name = '';
    /**
     * 企业代码
     * @var string
     */
    private $code = '';
    /**
     * 企业代码类型 1：统一社会信用代码(18位) 2：组织机构代码(9位) 3：营业执照注册号(15位)
     * @var int
     */
    private $code_type = 0;
    /**
     * 法人微信号
     * @var string
     */
    private $legal_persona_wechat = '';
    /**
     * 法人姓名
     * @var string
     */
    private $legal_persona_name = '';
    /**
     * 第三方联系电话
     * @var string
     */
    private $component_phone = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/component/fastregisterweapp?action=create&component_access_token=';
    }

    public function __clone()
    {
    }

    /**
     * @param string $name
     * @throws \SyException\Wx\WxOpenException
     */
    public function setName(string $name)
    {
        if (strlen($name) > 0) {
            $this->reqData['name'] = $name;
        } else {
            throw new WxOpenException('企业名不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    /**
     * @param string $code
     * @throws \SyException\Wx\WxOpenException
     */
    public function setCode(string $code)
    {
        if (strlen($code) > 0) {
            $this->reqData['code'] = $code;
        } else {
            throw new WxOpenException('企业代码不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    /**
     * @param int $codeType
     * @throws \SyException\Wx\WxOpenException
     */
    public function setCodeType(int $codeType)
    {
        if (in_array($codeType, [1, 2, 3], true)) {
            $this->reqData['code_type'] = $codeType;
        } else {
            throw new WxOpenException('企业代码类型不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    /**
     * @param string $legalPersonaWechat
     * @throws \SyException\Wx\WxOpenException
     */
    public function setLegalPersonaWechat(string $legalPersonaWechat)
    {
        if (strlen($legalPersonaWechat) > 0) {
            $this->reqData['legal_persona_wechat'] = $legalPersonaWechat;
        } else {
            throw new WxOpenException('法人微信号不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    /**
     * @param string $legalPersonaName
     * @throws \SyException\Wx\WxOpenException
     */
    public function setLegalPersonaName(string $legalPersonaName)
    {
        if (strlen($legalPersonaName) > 0) {
            $this->reqData['legal_persona_name'] = $legalPersonaName;
        } else {
            throw new WxOpenException('法人姓名不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    /**
     * @param string $componentPhone
     * @throws \SyException\Wx\WxOpenException
     */
    public function setComponentPhone(string $componentPhone)
    {
        if (strlen($componentPhone) > 0) {
            $this->reqData['component_phone'] = $componentPhone;
        } else {
            throw new WxOpenException('第三方联系电话不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['name'])) {
            throw new WxOpenException('企业名不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        if (!isset($this->reqData['code'])) {
            throw new WxOpenException('企业代码不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        if (!isset($this->reqData['code_type'])) {
            throw new WxOpenException('企业代码类型不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        if (!isset($this->reqData['legal_persona_wechat'])) {
            throw new WxOpenException('法人微信号不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        if (!isset($this->reqData['legal_persona_name'])) {
            throw new WxOpenException('法人姓名不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        if (!isset($this->reqData['component_phone'])) {
            throw new WxOpenException('第三方联系电话不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0
        ];

        $openAppId = WxConfigSingleton::getInstance()->getOpenCommonConfig()->getAppId();
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getComponentAccessToken($openAppId);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
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
