<?php
/**
 * 获取云函数列表
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

class FunctionList extends WxBaseOpenMini
{
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 环境id
     * @var string
     */
    private $env = '';
    /**
     * 偏移量
     * @var int
     */
    private $offset = 0;
    /**
     * 每页限制
     * @var int
     */
    private $limit = 0;

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/tcb/listfunctions?access_token=';
        $this->appId = $appId;
        $this->reqData = [
            'offset' => 0,
            'limit' => 10,
        ];
    }

    public function __clone()
    {
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
     * @param int $offset
     * @throws \SyException\Wx\WxOpenException
     */
    public function setOffset(int $offset)
    {
        if ($offset >= 0) {
            $this->reqData['offset'] = $offset;
        } else {
            throw new WxOpenException('偏移量不合法', ErrorCode::COMMON_PARAM_ERROR);
        }
    }

    /**
     * @param int $limit
     * @throws \SyException\Wx\WxOpenException
     */
    public function setLimit(int $limit)
    {
        if (($limit > 0) && ($limit <= 20)) {
            $this->reqData['limit'] = $limit;
        } else {
            throw new WxOpenException('每页限制不合法', ErrorCode::COMMON_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['env'])) {
            throw new WxOpenException('环境id不能为空', ErrorCode::COMMON_PARAM_ERROR);
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
