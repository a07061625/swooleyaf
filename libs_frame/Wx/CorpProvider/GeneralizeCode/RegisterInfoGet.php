<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/23 0023
 * Time: 8:51
 */

namespace Wx\CorpProvider\GeneralizeCode;

use SyConstant\ErrorCode;
use SyException\Wx\WxCorpProviderException;
use SyTool\Tool;
use Wx\WxBaseCorpProvider;
use Wx\WxUtilBase;
use Wx\WxUtilCorpProvider;

/**
 * 查询注册状态
 *
 * @package Wx\CorpProvider\GeneralizeCode
 */
class RegisterInfoGet extends WxBaseCorpProvider
{
    /**
     * 注册码
     *
     * @var string
     */
    private $register_code = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/service/get_register_info?provider_access_token=';
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public function setRegisterCode(string $registerCode)
    {
        if (\strlen($registerCode) > 0) {
            $this->reqData['register_code'] = $registerCode;
        } else {
            throw new WxCorpProviderException('注册码不合法', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['register_code'])) {
            throw new WxCorpProviderException('注册码不能为空', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . '?' . WxUtilCorpProvider::getProviderToken();
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (0 == $sendData['errcode']) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXPROVIDER_CORP_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
