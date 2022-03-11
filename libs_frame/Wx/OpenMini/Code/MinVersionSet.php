<?php
/**
 * 设置最低基础库版本
 * User: 姜伟
 * Date: 2018/9/13 0013
 * Time: 8:16
 */

namespace Wx\OpenMini\Code;

use SyConstant\ErrorCode;
use SyException\Wx\WxOpenException;
use SyTool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class MinVersionSet extends WxBaseOpenMini
{
    /**
     * 应用ID
     *
     * @var string
     */
    private $appId = '';
    /**
     * 最低版本号
     *
     * @var string
     */
    private $version = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/wxopen/setweappsupportversion?access_token=';
        $this->appId = $appId;
    }

    public function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setVersion(string $version)
    {
        if (\strlen($version) > 0) {
            $this->reqData['version'] = $version;
        } else {
            throw new WxOpenException('最低版本号不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['version'])) {
            throw new WxOpenException('最低版本号不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
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
