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

    /**
     * 生成码市签名
     * @param string $tag
     * @param string $body 请求体数据
     * @return string
     */
    public static function createCodingSign(string $tag, string $body)
    {
        $hookInfo = \ProjectCache\WebHook::getHookInfo($tag);
        $token = $hookInfo['token'] ?? '';
        if (strlen($token) == 0) {
            return '';
        }

        return 'sha1=' . hash_hmac('sha1', $body, $token);
    }

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
                    Log::log('webhook exec command: ' . $command . ',err_code:' . $execRes['code'] . ',err_msg:' . $execRes['msg']);
                    break;
                } else {
                    Log::log('webhook exec command: ' . $command);
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
