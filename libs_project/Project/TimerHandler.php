<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/8/15 0015
 * Time: 12:16
 */
namespace Project;

use Constant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use Factories\SyTaskMysqlFactory;
use Tool\Tool;
use Traits\SimpleTrait;

class TimerHandler {
    use SimpleTrait;

    private static function sendUrl(string $method,string $url,string $params) {
        $curlConfig = [
            CURLOPT_TIMEOUT_MS => 3000,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
        ];
        if($method == 'GET'){
            $curlConfig[CURLOPT_URL] = $url . '?' . $params;
        } else {
            $curlConfig[CURLOPT_URL] = $url;
            $curlConfig[CURLOPT_POST] = true;
            $curlConfig[CURLOPT_POSTFIELDS] = $params;
        }

        $sendRes = Tool::sendCurlReq($curlConfig);
        if ($sendRes['res_no'] == 0) {
            return $sendRes['res_content'];
        } else {
            return '{"code":' . $sendRes['res_no'] . ',"msg":"处理url请求失败"}';
        }
    }

    public static function handle(int $nowTime){
        //获取当前时间队列的任务列表
        $redisKeyQueue1 = Project::REDIS_PREFIX_TIMER_QUEUE . $nowTime;
        $taskBase = SyTaskMysqlFactory::TaskBaseEntity();
        $taskLog = SyTaskMysqlFactory::TaskLogEntity();
        $startIndex = 0;
        $endIndex = 99;
        $tagList = CacheSimpleFactory::getRedisInstance()->lRange($redisKeyQueue1, $startIndex, $endIndex);
        while (count($tagList) > 0) {
            foreach ($tagList as $eTag) {
                $redisKeyContent = Project::REDIS_PREFIX_TIMER_CONTENT . $eTag;
                $taskData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKeyContent);
                if(isset($taskData['unique_key']) && ($taskData['unique_key'] == $eTag)){
                    if($taskData['persist_type'] == Project::TASK_PERSIST_TYPE_SINGLE){
                        $ormResult1 = $taskBase->getContainer()->getModel()->getOrmDbTable();
                        $ormResult1->where('`tag`=? AND `status`=?', [$eTag, Project::TASK_STATUS_VALID]);
                        $taskBase->getContainer()->getModel()->update($ormResult1, [
                            'status' => Project::TASK_STATUS_INVALID,
                            'updated' => $nowTime,
                        ]);
                    }

                    $taskLog->getContainer()->getModel()->insert([
                        'tag' => $eTag,
                        'exec_result' => self::sendUrl($taskData['exec_method'], $taskData['exec_url'], $taskData['exec_params']),
                        'created' => $nowTime,
                    ]);

                    if($taskData['persist_type'] == Project::TASK_PERSIST_TYPE_INTERVAL){ //间隔任务,将任务加入到下一次的任务列表中
                        $needTime = $nowTime + $taskData['interval_time'];
                        $redisKeyQueue2 = Project::REDIS_PREFIX_TIMER_QUEUE . $needTime;
                        $listNum = CacheSimpleFactory::getRedisInstance()->rPush($redisKeyQueue2, $eTag);
                        if(in_array($listNum, [1, 2, 3])){
                            $expireTime = $needTime + Project::TASK_CACHE_EXPIRE_TIME;
                            CacheSimpleFactory::getRedisInstance()->expireAt($redisKeyQueue2, $expireTime);
                        }
                    }
                }
            }

            if(count($tagList) == 100){
                $startIndex += 100;
                $endIndex += 100;
                $tagList = CacheSimpleFactory::getRedisInstance()->lRange($redisKeyQueue1, $startIndex, $endIndex);
            } else {
                break;
            }
        }
        unset($ormResult1, $taskBase, $taskLog);
    }
}