<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/22 0022
 * Time: 14:44
 */
namespace SyVms;

use DesignPatterns\Singletons\VmsConfigSingleton;
use SyTrait\SimpleTrait;

/**
 * Class UtilChiVox
 *
 * @package SyVms
 */
abstract class UtilChiVox extends Util
{
    use SimpleTrait;

    private static $authAlgList = [
        'sha1' => 1,
        'sha256' => 1,
        'md5' => 1,
    ];

    /**
     * 生成签名
     *
     * @param string $alg 签名算法
     *
     * @return array
     *
     * @throws \SyException\Vms\ChiVoxException
     */
    public static function createSign(string $alg) : array
    {
        $trueAlg = isset(self::$authAlgList[$alg]) ? $alg : 'sha1';
        $nowTime = 1000 * time();
        $config = VmsConfigSingleton::getInstance()->getChiVoxConfig();

        return [
            'applicationId' => $config->getAppKey(),
            'sig' => hash($trueAlg, $config->getAppKey() . $nowTime . $config->getAppSecret()),
            'alg' => $trueAlg,
            'timestamp' => (string)$nowTime,
        ];
    }
}
