<?php
/**
 * 将第三方提交的代码包提交审核
 * User: 姜伟
 * Date: 2018/9/13 0013
 * Time: 7:34
 */

namespace Wx\OpenMini\Code;

use SyConstant\ErrorCode;
use SyException\Wx\WxOpenException;
use SyTool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class CodeAudit extends WxBaseOpenMini
{
    /**
     * 应用ID
     *
     * @var string
     */
    private $appId = '';
    /**
     * 审核列表
     *
     * @var array
     */
    private $auditList = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxa/submit_audit?access_token=';
        $this->appId = $appId;
    }

    public function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setAuditList(array $auditList)
    {
        $auditNum = \count($auditList);
        if (0 == $auditNum) {
            throw new WxOpenException('审核列表不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        if ($auditNum > 5) {
            throw new WxOpenException('审核列表数量不能超过5个', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $this->reqData['item_list'] = $auditList;
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['item_list'])) {
            throw new WxOpenException('审核列表不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
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
        if (0 == $sendData['errcode']) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXOPEN_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
