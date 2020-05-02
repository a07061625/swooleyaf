<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-13
 * Time: 上午12:38
 */
namespace Wx\OpenAccount;

use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Wx\WxOpenException;
use SyTool\ProjectWxTool;
use SyTool\Tool;
use Wx\WxBaseOpenAccount;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

/**
 * 第三方平台复用公众号主体快速注册小程序
 * @package Wx\OpenAccount
 */
class MiniFastRegister extends WxBaseOpenAccount
{
    /**
     * 公众号APPID
     * @var string
     */
    private $appid = '';
    /**
     * 授权凭证
     * @var string
     */
    private $ticket = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/account/fastregister?access_token=';
        $this->appid = $appId;
    }

    public function __clone()
    {
    }

    /**
     * @param string $ticket
     * @throws \SyException\Wx\WxOpenException
     */
    public function setTicket(string $ticket)
    {
        if (strlen($ticket) > 0) {
            $this->reqData['ticket'] = $ticket;
        } else {
            throw new WxOpenException('授权凭证不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['ticket'])) {
            throw new WxOpenException('授权凭证不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getAuthorizerAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            ProjectWxTool::handleAppAuthForOpen(Project::WX_COMPONENT_AUTHORIZER_OPTION_TYPE_AUTHORIZED, [
                'AuthorizerAppid' => $sendData['appid'],
                'AuthorizationCode' => $sendData['authorization_code'],
            ]);
            WxUtilOpenBase::getAuthorizerAccessToken($sendData['appid']);
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXOPEN_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
