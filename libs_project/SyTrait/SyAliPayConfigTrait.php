<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/21 0021
 * Time: 8:49
 */

namespace SyTrait;

use SyAliPay\AopClient;
use SyConstant\Project;
use SyTool\Tool;

trait SyAliPayConfigTrait
{
    /**
     * 更新支付配置
     */
    public function refreshClient(string $appId): AopClient
    {
        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_SY_ALIPAY_REFRESH;
        $client = new AopClient();
        $client->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
        $client->appId = $appId;
        $client->rsaPrivateKey = '你的应用私钥';
        $client->alipayrsaPublicKey = '你的支付宝公钥';
        $client->apiVersion = '1.0';
        $client->signType = 'RSA2';
        $client->postCharset = 'utf-8';
        $client->format = 'json';
        $client->setSyValid(true);
        $client->setSyExpireTime($expireTime);
        $this->clients[$appId] = $client;

        return $client;
    }
}
