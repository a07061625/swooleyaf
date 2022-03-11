<?php
/**
 * 修改功能介绍
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

class AccountSignatureModify extends WxBaseOpenMini
{
    /**
     * 应用ID
     *
     * @var string
     */
    private $appId = '';
    /**
     * 功能介绍
     *
     * @var string
     */
    private $signature = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/account/modifysignature?access_token=';
        $this->appId = $appId;
    }

    public function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setSignature(string $signature)
    {
        if (\strlen($signature) > 0) {
            $this->reqData['signature'] = $signature;
        } else {
            throw new WxOpenException('功能介绍不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['signature'])) {
            throw new WxOpenException('功能介绍不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
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
