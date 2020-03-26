<?php
/**
 * 获取云函数配置
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

class FunctionConfigGet extends WxBaseOpenMini
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
    /**
     * 环境id
     * @var string
     */
    private $env = '';
    /**
     * 云函数名
     * @var string
     */
    private $function_name = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/tcb/getfuncconfig?access_token=';
        $this->appId = $appId;
    }

    public function __clone()
    {
    }

    /**.
     * @param int $type
     * @throws \SyException\Wx\WxOpenException
     */
    public function setType(int $type)
    {
        if (in_array($type, [1, 2])) {
            $this->reqData['type'] = $type;
        } else {
            throw new WxOpenException('配置类型不合法', ErrorCode::COMMON_PARAM_ERROR);
        }
    }

    /**
     * @param string $env
     * @throws \SyException\Wx\WxOpenException
     */
    public function setEnv(string $env)
    {
        if (ctype_alnum($env)) {
            $this->reqData['env'] = $env;
        } else {
            throw new WxOpenException('环境id不合法', ErrorCode::COMMON_PARAM_ERROR);
        }
    }

    /**
     * @param string $functionName
     * @throws \SyException\Wx\WxOpenException
     */
    public function setFunctionName(string $functionName)
    {
        if (ctype_alnum($functionName)) {
            $this->reqData['function_name'] = $functionName;
        } else {
            throw new WxOpenException('云函数名不合法', ErrorCode::COMMON_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['type'])) {
            throw new WxOpenException('配置类型不能为空', ErrorCode::COMMON_PARAM_ERROR);
        }
        if (!isset($this->reqData['env'])) {
            throw new WxOpenException('环境id不能为空', ErrorCode::COMMON_PARAM_ERROR);
        }
        if (!isset($this->reqData['function_name'])) {
            throw new WxOpenException('云函数名不能为空', ErrorCode::COMMON_PARAM_ERROR);
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
