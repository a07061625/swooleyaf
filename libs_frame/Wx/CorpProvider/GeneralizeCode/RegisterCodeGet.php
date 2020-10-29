<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/23 0023
 * Time: 8:51
 */
namespace Wx\CorpProvider\GeneralizeCode;

use SyConstant\ErrorCode;
use SyException\Wx\WxCorpProviderException;
use SyTool\Tool;
use Wx\WxBaseCorpProvider;
use Wx\WxUtilBase;
use Wx\WxUtilCorpProvider;

/**
 * 获取注册码
 *
 * @package Wx\CorpProvider\GeneralizeCode
 */
class RegisterCodeGet extends WxBaseCorpProvider
{
    /**
     * 推广包ID
     *
     * @var string
     */
    private $template_id = '';
    /**
     * 企业名称
     *
     * @var string
     */
    private $corp_name = '';
    /**
     * 管理员姓名
     *
     * @var string
     */
    private $admin_name = '';
    /**
     * 管理员手机号
     *
     * @var string
     */
    private $admin_mobile = '';
    /**
     * 自定义状态值
     *
     * @var string
     */
    private $state = '';
    /**
     * 跟进人用户ID
     *
     * @var string
     */
    private $follow_user = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/service/get_register_code?provider_access_token=';
        $this->reqData['state'] = Tool::createNonceStr(8);
    }

    private function __clone()
    {
    }

    /**
     * @param string $templateId
     *
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public function setTemplateId(string $templateId)
    {
        $length = strlen($templateId);
        if (($length > 0) && ($length <= 128)) {
            $this->reqData['template_id'] = $templateId;
        } else {
            throw new WxCorpProviderException('推广包ID不合法', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }
    }

    /**
     * @param string $corpName
     */
    public function setCorpName(string $corpName)
    {
        if (strlen($corpName) > 0) {
            $this->reqData['corp_name'] = $corpName;
        } else {
            unset($this->reqData['corp_name']);
        }
    }

    /**
     * @param string $adminName
     */
    public function setAdminName(string $adminName)
    {
        if (strlen($adminName) > 0) {
            $this->reqData['admin_name'] = $adminName;
        } else {
            unset($this->reqData['admin_name']);
        }
    }

    /**
     * @param string $adminMobile
     *
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public function setAdminMobile(string $adminMobile)
    {
        if (ctype_digit($adminMobile) && (strlen($adminMobile) == 11) && ($adminMobile[0] == '1')) {
            $this->reqData['admin_mobile'] = $adminMobile;
        } else {
            throw new WxCorpProviderException('管理员手机号不合法', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }
    }

    /**
     * @param string $state
     *
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public function setState(string $state)
    {
        if (ctype_alnum($state) && (strlen($state) <= 128)) {
            $this->reqData['state'] = $state;
        } else {
            throw new WxCorpProviderException('自定义状态值不合法', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }
    }

    /**
     * @param string $followUser
     */
    public function setFollowUser(string $followUser)
    {
        if (strlen($followUser) > 0) {
            $this->reqData['follow_user'] = $followUser;
        } else {
            unset($this->reqData['follow_user']);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['template_id'])) {
            throw new WxCorpProviderException('推广包ID不能为空', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . '?' . WxUtilCorpProvider::getProviderToken();
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXPROVIDER_CORP_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
