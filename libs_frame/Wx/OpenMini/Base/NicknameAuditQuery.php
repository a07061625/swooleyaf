<?php
/**
 * 小程序改名审核状态查询
 * User: 姜伟
 * Date: 2018/9/13 0013
 * Time: 7:34
 */
namespace Wx\OpenMini\Base;

use SyConstant\ErrorCode;
use SyException\Wx\WxOpenException;
use SyTool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class NicknameAuditQuery extends WxBaseOpenMini
{
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 审核id
     * @var string
     */
    private $audit_id = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxa/api_wxa_querynickname?access_token=';
        $this->appId = $appId;
    }

    public function __clone()
    {
    }

    /**
     * @param string $auditId
     * @throws \SyException\Wx\WxOpenException
     */
    public function setAuditId(string $auditId)
    {
        if (ctype_alnum($auditId)) {
            $this->reqData['audit_id'] = $auditId;
        } else {
            throw new WxOpenException('审核id不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['audit_id'])) {
            throw new WxOpenException('审核id不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getAuthorizerAccessToken($this->appId);
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
