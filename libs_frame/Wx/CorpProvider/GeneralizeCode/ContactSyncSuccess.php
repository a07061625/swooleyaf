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

/**
 * 设置通讯录同步完成
 * @package Wx\CorpProvider\GeneralizeCode
 */
class ContactSyncSuccess extends WxBaseCorpProvider
{
    /**
     * 令牌,由查询注册状态接口返回
     * @var string
     */
    private $access_token = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/sync/contact_sync_success?access_token=';
    }

    private function __clone()
    {
    }

    /**
     * @param string $accessToken
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public function setAccessToken(string $accessToken)
    {
        if (strlen($accessToken) > 0) {
            $this->access_token = $accessToken;
        } else {
            throw new WxCorpProviderException('令牌不合法', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->access_token) == 0) {
            throw new WxCorpProviderException('令牌不能为空', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . '?' . $this->access_token;
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXPROVIDER_CORP_GET_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
