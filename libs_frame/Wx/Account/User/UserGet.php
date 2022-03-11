<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/13 0013
 * Time: 15:12
 */

namespace Wx\Account\User;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseAccount;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class UserGet extends WxBaseAccount
{
    /**
     * 公众号ID
     *
     * @var string
     */
    private $appid = '';
    /**
     * 第一个用户openid
     *
     * @var string
     */
    private $next_openid = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token=';
        $this->appid = $appId;
        $this->reqData['next_openid'] = '';
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setNextOpenid(string $nextOpenid)
    {
        if (preg_match(ProjectBase::REGEX_WX_OPEN_ID, $nextOpenid) > 0) {
            $this->reqData['next_openid'] = $nextOpenid;
        } else {
            throw new WxException('用户openid不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAccount::getAccessToken($this->appid) . '&next_openid=' . $this->reqData['next_openid'];
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['errcode'])) {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        } else {
            $resArr['data'] = $sendData;
        }

        return $resArr;
    }
}
