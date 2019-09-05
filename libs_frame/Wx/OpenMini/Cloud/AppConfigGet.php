<?php
/**
 * 获取小程序配置
 * User: 姜伟
 * Date: 18-9-13
 * Time: 上午12:17
 */
namespace Wx\OpenMini\Cloud;

use SyConstant\ErrorCode;
use SyException\Wx\WxOpenException;
use Tool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class AppConfigGet extends WxBaseOpenMini
{
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 配置类型
     * @var int
     */
    private $type = 0;

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/tcb/getappconfig?access_token=';
        $this->appId = $appId;
    }

    public function __clone()
    {
    }

    /**
     * @param int $type
     * @throws \SyException\Wx\WxOpenException
     */
    public function setType(int $type)
    {
        if (in_array($type, [1])) {
            throw new WxOpenException('配置类型不合法', ErrorCode::COMMON_PARAM_ERROR);
        } else {
            $this->reqData['type'] = $type;
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['type'])) {
            throw new WxOpenException('配置类型不能为空', ErrorCode::COMMON_PARAM_ERROR);
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
