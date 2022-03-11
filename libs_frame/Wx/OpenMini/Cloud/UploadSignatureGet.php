<?php
/**
 * 获取上传云函数签名header
 * User: 姜伟
 * Date: 18-9-13
 * Time: 上午12:17
 */

namespace Wx\OpenMini\Cloud;

use SyConstant\ErrorCode;
use SyException\Wx\WxOpenException;
use SyTool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class UploadSignatureGet extends WxBaseOpenMini
{
    /**
     * 应用ID
     *
     * @var string
     */
    private $appId = '';
    /**
     * 上传签名
     *
     * @var string
     */
    private $hashed_payload = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/tcb/getuploadsignature?access_token=';
        $this->appId = $appId;
    }

    public function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setHashedPayload(string $hashedPayload)
    {
        if (ctype_alnum($hashedPayload) && (64 == \strlen($hashedPayload))) {
            $this->reqData['hashed_payload'] = $hashedPayload;
        } else {
            throw new WxOpenException('上传签名不合法', ErrorCode::COMMON_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['hashed_payload'])) {
            throw new WxOpenException('上传签名不能为空', ErrorCode::COMMON_PARAM_ERROR);
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
