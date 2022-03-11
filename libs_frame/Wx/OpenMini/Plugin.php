<?php
/**
 * 小程序插件管理接口
 * User: 姜伟
 * Date: 2018/9/13 0013
 * Time: 8:58
 */

namespace Wx\OpenMini;

use SyConstant\ErrorCode;
use SyException\Wx\WxOpenException;
use SyTool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class Plugin extends WxBaseOpenMini
{
    /**
     * 应用ID
     *
     * @var string
     */
    private $appId = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxa/plugin?access_token=';
        $this->appId = $appId;
    }

    public function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setData(string $action, array $data)
    {
        if ('apply' == $action) {
            if (!ctype_alnum($data['plugin_appid'])) {
                throw new WxOpenException('插件appid不合法', ErrorCode::WXOPEN_PARAM_ERROR);
            }
            $this->reqData = [
                'plugin_appid' => $data['plugin_appid'],
            ];
        } elseif ('list' == $action) {
            $this->reqData = [];
        } elseif ('unbind' == $action) {
            if (!ctype_alnum($data['plugin_appid'])) {
                throw new WxOpenException('插件appid不合法', ErrorCode::WXOPEN_PARAM_ERROR);
            }
            $this->reqData = [
                'plugin_appid' => $data['plugin_appid'],
            ];
        } elseif ('update' == $action) {
            if (!ctype_alnum($data['plugin_appid'])) {
                throw new WxOpenException('插件appid不合法', ErrorCode::WXOPEN_PARAM_ERROR);
            }
            if (!isset($data['user_version'])) {
                throw new WxOpenException('版本号不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
            }
            $this->reqData = [
                'user_version' => $data['user_version'],
                'plugin_appid' => $data['plugin_appid'],
            ];
        } else {
            throw new WxOpenException('操作类型不支持', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $this->reqData['action'] = $action;
    }

    public function getDetail(): array
    {
        if (empty($this->reqData)) {
            throw new WxOpenException('数据不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
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
