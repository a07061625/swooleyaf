<?php
/**
 * 设置小程序业务域名
 * User: 姜伟
 * Date: 18-9-13
 * Time: 上午12:29
 */

namespace Wx\OpenMini;

use SyConstant\ErrorCode;
use SyException\Wx\WxOpenException;
use SyTool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class DomainWebViewSet extends WxBaseOpenMini
{
    /**
     * 应用ID
     *
     * @var string
     */
    private $appId = '';
    /**
     * 数据
     *
     * @var array
     */
    private $data = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxa/setwebviewdomain?access_token=';
        $this->appId = $appId;
    }

    public function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setData(string $action, array $domains = [])
    {
        if (!\in_array($action, ['add', 'delete', 'set', 'get'], true)) {
            throw new WxOpenException('操作类型不支持', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        if ('get' != $action) {
            if (empty($domains)) {
                throw new WxOpenException('域名不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
            }

            $this->data = $domains;
            $this->data['action'] = $action;
        } else {
            $this->data = [
                'action' => $action,
            ];
        }
    }

    public function getDetail(): array
    {
        if (empty($this->data)) {
            throw new WxOpenException('数据不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getAuthorizerAccessToken($this->appId);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->data, JSON_UNESCAPED_UNICODE);
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
