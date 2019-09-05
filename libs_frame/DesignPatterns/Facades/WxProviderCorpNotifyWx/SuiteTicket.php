<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/21 0021
 * Time: 15:27
 */
namespace DesignPatterns\Facades\WxProviderCorpNotifyWx;

use SyConstant\Project;
use DesignPatterns\Facades\WxProviderCorpNotifyWxFacade;
use DesignPatterns\Factories\CacheSimpleFactory;
use SyTrait\SimpleFacadeTrait;

class SuiteTicket extends WxProviderCorpNotifyWxFacade
{
    use SimpleFacadeTrait;

    protected static function handleNotify(array $data)
    {
        $redisKey = Project::REDIS_PREFIX_WX_PROVIDER_CORP_ACCOUNT_SUITE . $data['SuiteId'];
        CacheSimpleFactory::getRedisInstance()->hMSet($redisKey, [
            'unique_key' => $redisKey,
            'ticket' => $data['SuiteTicket'],
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 1800);
    }
}
