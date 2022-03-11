<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/20 0020
 * Time: 10:52
 */

namespace Wx\Account\CustomService;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseAccount;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class SessionClose extends WxBaseAccount
{
    /**
     * 公众号ID
     *
     * @var string
     */
    private $appid = '';
    /**
     * 客服帐号 格式为: 帐号前缀@公众号微信号
     *
     * @var string
     */
    private $kf_account = '';
    /**
     * 用户openid
     *
     * @var string
     */
    private $openid = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/customservice/kfsession/close?access_token=';
        $this->appid = $appId;
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setKfAccount(string $kfAccount)
    {
        $accountLength = \strlen($kfAccount);
        if (($accountLength > 0) && ($accountLength <= 30)) {
            $this->reqData['kf_account'] = $kfAccount;
        } else {
            throw new WxException('客服帐号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setOpenid(string $openid)
    {
        if (preg_match(ProjectBase::REGEX_WX_OPEN_ID, $openid) > 0) {
            $this->reqData['openid'] = $openid;
        } else {
            throw new WxException('用户openid不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['kf_account'])) {
            throw new WxException('客服帐号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['openid'])) {
            throw new WxException('用户openid不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAccount::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (0 == $sendData['errcode']) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
