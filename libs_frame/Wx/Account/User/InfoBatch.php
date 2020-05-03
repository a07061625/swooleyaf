<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-12
 * Time: 上午12:36
 */
namespace Wx\Account\User;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseAccount;
use Wx\WxUtilBase;
use Wx\WxUtilAlone;

class InfoBatch extends WxBaseAccount
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 用户openid列表
     * @var array
     */
    private $openidList = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/user/info/batchget?access_token=';
        $this->appid = $appId;
    }

    public function __clone()
    {
    }

    /**
     * @param array $openidList
     */
    public function setOpenidList(array $openidList)
    {
        foreach ($openidList as $eOpenid) {
            if (is_string($eOpenid) && (strlen($eOpenid) == 28)) {
                $this->openidList[$eOpenid] = 1;
            }
        }
    }

    /**
     * @param string $openid
     * @throws \SyException\Wx\WxException
     */
    public function addOpenid(string $openid)
    {
        if (strlen($openid) == 28) {
            $this->openidList[$openid] = 1;
        } else {
            throw new WxException('用户openid不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        $num = count($this->openidList);
        if ($num == 0) {
            throw new WxException('用户openid列表不能为空', ErrorCode::WX_PARAM_ERROR);
        } elseif ($num > 100) {
            throw new WxException('用户openid列表超过100个', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['user_list'] = [];
        foreach ($this->openidList as $eOpenid => $val) {
            $this->reqData['user_list'][] = [
                'openid' => $eOpenid,
                'lang' => 'zh-CN',
            ];
        }

        $resArr = [
            'code' => 0
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAlone::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['user_info_list'])) {
            $resArr['data'] = $sendData['user_info_list'];
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
