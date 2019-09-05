<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/21 0021
 * Time: 15:27
 */
namespace DesignPatterns\Facades\DingTalkProviderNotify;

use SyConstant\Project;
use DesignPatterns\Facades\DingTalkProviderNotifyFacade;
use DesignPatterns\Factories\CacheSimpleFactory;
use SyTrait\SimpleFacadeTrait;

class SuiteTicket extends DingTalkProviderNotifyFacade
{
    use SimpleFacadeTrait;

    protected static function handleNotify(array $data)
    {
        $redisKey = Project::REDIS_PREFIX_DINGTALK_PROVIDER_ACCOUNT_SUITE . $data['SuiteKey'];
        CacheSimpleFactory::getRedisInstance()->hMSet($redisKey, [
            'unique_key' => $redisKey,
            'ticket' => $data['SuiteTicket'],
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 3600);
    }
}
