<?php
/**
 * 设置小程序隐私设置（是否可被搜索）
 * User: 姜伟
 * Date: 2018/9/13 0013
 * Time: 8:43
 */
namespace Wx\OpenMini\Base;

use SyConstant\ErrorCode;
use SyException\Wx\WxOpenException;
use SyTool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class SearchStatusChange extends WxBaseOpenMini
{
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 搜索状态
     * @var int
     */
    private $searchStatus = 0;

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxa/changewxasearchstatus?access_token=';
        $this->appId = $appId;
    }

    public function __clone()
    {
    }

    /**
     * @param int $searchStatus
     * @throws \SyException\Wx\WxOpenException
     */
    public function setSearchStatus(int $searchStatus)
    {
        if (in_array($searchStatus, [0, 1], true)) {
            $this->reqData['status'] = $searchStatus;
        } else {
            throw new WxOpenException('搜索状态不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['status'])) {
            throw new WxOpenException('搜索状态不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
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
