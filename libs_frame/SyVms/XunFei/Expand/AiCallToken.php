<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/17 0017
 * Time: 16:42
 */
namespace SyVms\XunFei\Expand;

use DesignPatterns\Singletons\VmsConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Vms\XunFeiException;
use SyTool\Tool;
use SyVms\BaseXunFei;
use SyVms\UtilXunFei;

/**
 * 获取token
 * @package SyVms\XunFei\Expand
 */
class AiCallToken extends BaseXunFei
{
    public function __construct()
    {
        parent::__construct();
        $this->reqMethod = 'POST';
        $this->serviceUrl = 'https://callapi.xfyun.cn/v1/service/v1/aicall/oauth/v1/token';
        $this->reqHeaders['Cache-Control'] = 'no-cache';

        $config = VmsConfigSingleton::getInstance()->getXunFeiConfig();
        $this->reqData = [
            'app_key' => $config->getApiKey(),
            'app_secret' => $config->getApiSecret(),
        ];
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        $this->getContent();
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = UtilXunFei::sendRequest($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        $errCode = $sendData['code'] ?? -1;
        if ($errCode != 0) {
            $errMsg = $sendData['message'] ?? '解析数据出错';
            throw new XunFeiException($errMsg, ErrorCode::VMS_REQ_XUNFEI_ERROR);
        }

        return $sendData;
    }
}
