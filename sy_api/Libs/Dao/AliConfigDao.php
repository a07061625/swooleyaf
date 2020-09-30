<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/8/10 0010
 * Time: 15:53
 */
namespace Dao;

use DesignPatterns\Singletons\ObjectStorageConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Common\CheckException;
use SyObjectStorage\Oss\OssTool;
use SyTool\Tool;
use SyTrait\SimpleDaoTrait;

class AliConfigDao
{
    use SimpleDaoTrait;

    private static $ossFrontMap = [
        'video' => 'getOssFrontVideo',
        'image' => 'getOssFrontImage',
    ];

    public static function getOssFront(array $data)
    {
        $funcName = Tool::getArrayVal(self::$ossFrontMap, $data['upload_type'], null);
        if (is_null($funcName)) {
            throw new CheckException('上传类型不支持', ErrorCode::COMMON_PARAM_ERROR);
        }

        $defineConfig = self::$funcName($data);
        $nowTime = Tool::getNowTime();
        $expireTime = $nowTime + 1800;
        $successStatus = '200';
        $signRes = OssTool::signFrontPolicy($data['access_key'], [
            'expiration' => gmdate("Y-m-d\TH:i:s.000\Z", $expireTime),
            'conditions' => [
                ['content-length-range', 1, $defineConfig['max_size']],
                ['starts-with', '$key', $defineConfig['upload_path']],
                ['success_action_status' => $successStatus],
            ],
        ]);
        $ossConfig = ObjectStorageConfigSingleton::getInstance()->getOssConfig($data['access_key']);

        return [
            'key_id' => $ossConfig->getAccessKey(),
            'policy' => $signRes['policy_sign'],
            'signature' => $signRes['signature'],
            'upload_path' => $defineConfig['upload_path'],
            'bucket_domain' => $ossConfig->getBucketDomain(),
            'oss_host' => 'http://' . $ossConfig->getBucketName() . '.' . $ossConfig->getEndpointDomain(),
            'max_size' => $defineConfig['max_size'],
            'success_status' => $successStatus,
            'expire_time' => $expireTime,
        ];
    }

    private static function getOssFrontVideo(array $data)
    {
        return [
            'max_size' => 62914560,
            'upload_path' => 'video/' . date('Ym') . '/',
        ];
    }

    private static function getOssFrontImage(array $data)
    {
        return [
            'max_size' => 5242880,
            'upload_path' => 'image/' . date('Ym') . '/',
        ];
    }
}
