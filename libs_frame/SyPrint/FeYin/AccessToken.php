<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/11 0011
 * Time: 8:14
 */
namespace SyPrint\FeYin;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\PrintConfigSingleton;
use SyException\SyPrint\FeYinException;
use SyPrint\PrintBaseFeYin;
use SyPrint\PrintUtilBase;
use SyTool\Tool;

class AccessToken extends PrintBaseFeYin
{
    public function __construct(string $appId)
    {
        parent::__construct();
        $config = PrintConfigSingleton::getInstance()->getFeYinConfig($appId);
        $this->reqData['code'] = $config->getMemberCode();
        $this->reqData['secret'] = $config->getAppKey();
        $this->reqData['appid'] = $config->getAppId();
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/token?' . http_build_query($this->reqData);
        $sendRes = PrintUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (!is_array($sendData)) {
            throw new FeYinException('获取access token出错', ErrorCode::PRINT_GET_ERROR);
        } elseif (!isset($sendData['access_token'])) {
            throw new FeYinException($sendData['errmsg'], ErrorCode::PRINT_GET_ERROR);
        }

        return $sendData;
    }
}
