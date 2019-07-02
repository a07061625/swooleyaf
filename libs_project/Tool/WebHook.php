<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/2 0002
 * Time: 10:42
 */
namespace Tool;

use DesignPatterns\Factories\CacheSimpleFactory;
use Log\Log;
use Traits\SimpleTrait;

final class WebHook
{
    use SimpleTrait;

    public static function handleHook()
    {
        $queueKey = \ProjectCache\WebHook::getCacheQueueKey();
        $queueData = CacheSimpleFactory::getRedisInstance()->rPop($queueKey);
        if (is_bool($queueData)) {
            return [];
        }

        $queueArr = Tool::jsonDecode($queueData);
        $statusKey = \ProjectCache\WebHook::getCacheStatusKey($queueArr['tag']);
        $statusData = CacheSimpleFactory::getRedisInstance()->get($statusKey);
        if ($statusData == '2') { //执行中
            CacheSimpleFactory::getRedisInstance()->lPush($queueKey, $queueData);
            CacheSimpleFactory::getRedisInstance()->expire($queueKey, 86400);
            return [];
        }

        CacheSimpleFactory::getRedisInstance()->set($statusKey, '2', 86400);
        try {
            $commands = \ProjectCache\WebHook::getCommandList($queueArr['tag'], $queueArr['event'], $queueArr['msg_prefix']);
            foreach ($commands as $command) {
                $execRes = Tool::execSystemCommand($command);
                if ($execRes['code'] > 0) {
                    Log::log('webhook exec command: ' . $command . ',err_msg:' . $execRes['msg']);
                    break;
                }
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());
        } finally {
            CacheSimpleFactory::getRedisInstance()->del($statusKey);
        }

        return [];
    }
}
