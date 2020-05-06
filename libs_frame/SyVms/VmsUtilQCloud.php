<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/5/6 0006
 * Time: 19:13
 */
namespace SyVms;

use DesignPatterns\Singletons\VmsConfigSingleton;
use SyTool\Tool;
use SyTrait\SimpleTrait;

/**
 * Class VmsUtilQCloud
 * @package SyVms
 */
abstract class VmsUtilQCloud extends VmsUtilBase
{
    use SimpleTrait;

    /**
     * 生成签名
     * @param array $data
     * @return array
     */
    public static function createSign(array $data) : array
    {
        $randomStr = Tool::createNonceStr(16, 'numlower');
        $nowTime = Tool::getNowTime();
        $config = VmsConfigSingleton::getInstance()->getQCloudConfig();
        $signStr = 'appkey=' . $config->getAppKey() . '&random=' . $randomStr . '&time=' . $nowTime . '&mobile=' . $data['mobile'];

        return [
            'random' => $randomStr,
            'time' => $nowTime,
            'app_id' => $config->getAppId(),
            'sign' => hash('sha256', $signStr),
        ];
    }
}
