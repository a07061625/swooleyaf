<?php
/**
 * 小程序分阶段发布
 * User: 姜伟
 * Date: 2018/9/13 0013
 * Time: 8:28
 */

namespace Wx\OpenMini\Code;

use SyConstant\ErrorCode;
use SyException\Wx\WxOpenException;
use SyTool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class CodeGrayRelease extends WxBaseOpenMini
{
    /**
     * 应用ID
     *
     * @var string
     */
    private $appId = '';
    /**
     * 灰度百分比
     *
     * @var int
     */
    private $percentage = 0;

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxa/grayrelease?access_token=';
        $this->appId = $appId;
    }

    public function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxOpenException
     */
    public function setPercentage(int $percentage)
    {
        if (($percentage > 0) && ($percentage <= 100)) {
            $this->reqData['gray_percentage'] = $percentage;
        } else {
            throw new WxOpenException('灰度百分比不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['gray_percentage'])) {
            throw new WxOpenException('灰度百分比不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
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
