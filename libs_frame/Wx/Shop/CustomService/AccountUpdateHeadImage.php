<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/20 0020
 * Time: 10:52
 */
namespace Wx\Shop\CustomService;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilShop;

class AccountUpdateHeadImage extends WxBaseShop
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 客服帐号 格式为: 帐号前缀@公众号微信号
     * @var string
     */
    private $kf_account = '';
    /**
     * 文件全路径,包括文件名
     * @var string
     */
    private $file_path = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/customservice/kfaccount/uploadheadimg?access_token=';
        $this->appid = $appId;
    }

    private function __clone()
    {
    }

    /**
     * @param string $kfAccount
     * @throws \SyException\Wx\WxException
     */
    public function setKfAccount(string $kfAccount)
    {
        $accountLength = strlen($kfAccount);
        if (($accountLength > 0) && ($accountLength <= 30)) {
            $this->kf_account = $kfAccount;
        } else {
            throw new WxException('客服帐号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $filePath
     * @throws \SyException\Wx\WxException
     */
    public function setFilePath(string $filePath)
    {
        if (file_exists($filePath) && is_readable($filePath)) {
            $this->reqData['media'] = new \CURLFile($filePath);
        } else {
            throw new WxException('文件不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->kf_account) == 0) {
            throw new WxException('客服帐号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['media'])) {
            throw new WxException('文件不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilShop::getAccessToken($this->appid) . '&kf_account=' . urlencode($this->kf_account);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $this->reqData;
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
