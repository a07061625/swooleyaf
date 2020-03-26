<?php
/**
 * 设置展示的公众号
 * User: 姜伟
 * Date: 2018/9/13 0013
 * Time: 7:21
 */
namespace Wx\OpenMini\Base;

use SyConstant\ErrorCode;
use SyException\Wx\WxOpenException;
use SyTool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class ShowItemUpdate extends WxBaseOpenMini
{
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 展示公众号开启标识 0:关闭 1:开启
     * @var int
     */
    private $wxa_subscribe_biz_flag = 0;

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxa/updateshowwxaitem?access_token=';
        $this->appId = $appId;
        $this->reqData['wxa_subscribe_biz_flag'] = 0;
    }

    public function __clone()
    {
    }

    /**
     * @param int $flag
     * @param string $appId
     * @throws \SyException\Wx\WxOpenException
     */
    public function setFlagAndAppId(int $flag, string $appId = '')
    {
        if (!in_array($flag, [0, 1])) {
            throw new WxOpenException('展示公众号开启标识不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        if (($flag == 1) && !ctype_alnum($appId)) {
            throw new WxOpenException('公众号应用ID不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $this->reqData['wxa_subscribe_biz_flag'] = $flag;
        if ($flag == 1) {
            $this->reqData['appid'] = $appId;
        } else {
            unset($this->reqData['appid']);
        }
    }

    public function getDetail() : array
    {
        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getAuthorizerAccessToken($this->appId);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
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
