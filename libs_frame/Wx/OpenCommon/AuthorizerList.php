<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 17:32
 */

namespace Wx\OpenCommon;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyTool\Tool;
use Wx\WxBaseOpenCommon;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

/**
 * 拉取当前所有已授权的帐号基本信息列表
 *
 * @package Wx\OpenCommon
 */
class AuthorizerList extends WxBaseOpenCommon
{
    /**
     * 第三方平台APPID
     *
     * @var string
     */
    private $component_appid = '';
    /**
     * 偏移位置
     *
     * @var int
     */
    private $offset = 0;
    /**
     * 拉取数量
     *
     * @var int
     */
    private $count = 0;

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/component/api_get_authorizer_list?component_access_token=';
        $this->reqData['component_appid'] = WxConfigSingleton::getInstance()->getOpenCommonConfig()->getAppId();
        $this->reqData['offset'] = 0;
        $this->reqData['count'] = 20;
    }

    public function __clone()
    {
        //do nothing
    }

    /**
     * 设置范围
     */
    public function setRange(int $page, int $limit)
    {
        $truePage = $page > 0 ? $page : 1;
        $this->reqData['count'] = ($limit > 0) && ($limit <= 500) ? $limit : 500;
        $this->reqData['offset'] = ($truePage - 1) * $this->reqData['count'];
    }

    public function getDetail(): array
    {
        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getComponentAccessToken($this->reqData['component_appid']);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['errcode'])) {
            $resArr['code'] = ErrorCode::WXOPEN_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        } else {
            $resArr['data'] = $sendData;
        }

        return $resArr;
    }
}
