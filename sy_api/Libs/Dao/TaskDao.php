<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 18-2-4
 * Time: 上午11:51
 */
namespace Dao;

use Constant\ErrorCode;
use Constant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use Exception\Common\CheckException;
use Factories\SyTaskMysqlFactory;
use Request\SyRequest;
use Tool\Tool;
use Traits\SimpleDaoTrait;

class TaskDao {
    use SimpleDaoTrait;

    private static $addTaskMap = [
        Project::TASK_PERSIST_TYPE_SINGLE => 'addSingleTask',
        Project::TASK_PERSIST_TYPE_INTERVAL => 'addIntervalTask',
    ];

    private static function setTaskCache(array $data) {
        $needTime = $data['start_time'] + $data['interval_time'];
        $expireTime = $needTime + Project::TASK_CACHE_EXPIRE_TIME;
        if($data['persist_type'] == Project::TASK_PERSIST_TYPE_SINGLE){
            $redisKeyQueue = Project::REDIS_PREFIX_TIMER_QUEUE . $needTime;
        } else {
            $redisKeyQueue = Project::REDIS_PREFIX_TIMER_QUEUE . $data['start_time'];
        }
        $listNum = CacheSimpleFactory::getRedisInstance()->rPush($redisKeyQueue, $data['task_tag']);
        if(in_array($listNum, [1, 2, 3])){
            CacheSimpleFactory::getRedisInstance()->expireAt($redisKeyQueue, $expireTime);
        }

        $redisKeyContent = Project::REDIS_PREFIX_TIMER_CONTENT . $data['task_tag'];
        CacheSimpleFactory::getRedisInstance()->hMset($redisKeyContent, [
            'unique_key' => $data['task_tag'],
            'persist_type' => $data['persist_type'],
            'exec_method' => $data['task_method'],
            'exec_url' => $data['task_url'],
            'exec_params' => empty($data['task_params']) ? '_tp=' : http_build_query($data['task_params']),
            'interval_time' => $data['interval_time'],
        ]);
        if($data['persist_type'] == Project::TASK_PERSIST_TYPE_SINGLE){
            CacheSimpleFactory::getRedisInstance()->expireAt($redisKeyContent, $expireTime);
        }
    }

    private static function addSingleTask(array &$data) {
        $needTime = Tool::getNowTime() + 10;
        $startTime = (int)SyRequest::getParams('start_time', $needTime);
        if($startTime < $needTime){
            throw new CheckException('任务开始时间必须超过当前时间10秒', ErrorCode::COMMON_PARAM_ERROR);
        }

        $data['start_time'] = $startTime;
    }

    private static function addIntervalTask(array &$data) {
        $nowTime = Tool::getNowTime();
        $startTime = (int)SyRequest::getParams('start_time', 0);
        if($startTime <= 0){
            throw new CheckException('开始时间不能为空', ErrorCode::COMMON_PARAM_ERROR);
        } else if(($startTime - $nowTime) < 5){
            throw new CheckException('开始时间必须超过当前时间5秒', ErrorCode::COMMON_PARAM_ERROR);
        }

        $data['start_time'] = $startTime;
    }

    public static function addTask(array $data) {
        $funcName = Tool::getArrayVal(self::$addTaskMap, $data['persist_type'], null);
        if (is_null($funcName)) {
            throw new CheckException('持久化类型不支持', ErrorCode::COMMON_PARAM_ERROR);
        }
        self::$funcName($data);

        $nowTime = Tool::getNowTime();
        $taskTag = Tool::createNonceStr(6, 'numlower') . $nowTime;
        $taskBase = SyTaskMysqlFactory::TaskBaseEntity();
        $taskBase->tag = $taskTag;
        $taskBase->task_title = $data['task_title'];
        $taskBase->task_desc = $data['task_desc'];
        $taskBase->persist_type = $data['persist_type'];
        $taskBase->exec_method = $data['task_method'];
        $taskBase->exec_obj = $data['task_url'];
        $taskBase->exec_params = Tool::jsonEncode($data['task_params'], JSON_UNESCAPED_UNICODE);
        $taskBase->start_time = $data['start_time'];
        $taskBase->interval_time = $data['interval_time'];
        $taskBase->status = Project::TASK_STATUS_VALID;
        $taskBase->created = $nowTime;
        $taskBase->updated = $nowTime;
        $taskId = $taskBase->getContainer()->getModel()->insert($taskBase->getEntityDataArray());
        unset($taskBase);
        if (!$taskId) {
            throw new CheckException('添加任务失败', ErrorCode::COMMON_SERVER_ERROR);
        }

        self::setTaskCache([
            'task_tag' => $taskTag,
            'task_url' => $data['task_url'],
            'task_method' => $data['task_method'],
            'task_params' => $data['task_params'],
            'start_time' => $data['start_time'],
            'persist_type' => $data['persist_type'],
            'interval_time' => $data['interval_time'],
        ]);

        return [
            'task_id' => $taskId,
            'task_tag' => $taskTag,
        ];
    }

    public static function delTask(array $data) {
        $taskBase = SyTaskMysqlFactory::TaskBaseEntity();
        $ormResult1 = $taskBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag`=?', [$data['task_tag']]);
        $effectNum = $taskBase->getContainer()->getModel()->update($ormResult1, [
            'status' => Project::TASK_STATUS_DELETE,
            'updated' => Tool::getNowTime(),
        ]);
        unset($ormResult1, $taskBase);

        $redisKey = Project::REDIS_PREFIX_TIMER_CONTENT . $data['task_tag'];
        CacheSimpleFactory::getRedisInstance()->del($redisKey);

        return [
            'del_num' => $effectNum,
        ];
    }

    public static function refreshTask(array $data){
        $taskBase = SyTaskMysqlFactory::TaskBaseEntity();
        $ormResult1 = $taskBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag`=?', [$data['task_tag']]);
        $taskBaseInfo = $taskBase->getContainer()->getModel()->findOne($ormResult1);
        if(empty($taskBaseInfo)){
            throw new CheckException('任务信息不存在', ErrorCode::COMMON_PARAM_ERROR);
        } else if($taskBaseInfo['status'] != Project::TASK_STATUS_VALID){
            throw new CheckException('只有有效的任务才能刷新', ErrorCode::COMMON_PARAM_ERROR);
        }
        unset($ormResult1, $taskBase);

        self::setTaskCache([
            'task_tag' => $data['task_tag'],
            'task_url' => $taskBaseInfo['exec_obj'],
            'task_method' => $taskBaseInfo['exec_method'],
            'task_params' => strlen($taskBaseInfo['exec_params']) > 0 ? Tool::jsonDecode($taskBaseInfo['exec_params']) : [],
            'start_time' => Tool::getNowTime() + 10,
            'persist_type' => $taskBaseInfo['persist_type'],
            'interval_time' => $taskBaseInfo['interval_time'],
        ]);

        return [
            'msg' => '刷新成功',
        ];
    }

    public static function getTaskList(array $data) {
        $taskBase = SyTaskMysqlFactory::TaskBaseEntity();
        $ormResult1 = $taskBase->getContainer()->getModel()->getOrmDbTable();
        if ($data['persist_type'] > 0) {
            $ormResult1->where('`persist_type`=?', [$data['persist_type']]);
        }
        if ($data['task_status'] > -2) {
            $ormResult1->where('`status`=?', [$data['task_status']]);
        }
        $ormResult1->order('`created` DESC,`id` DESC');
        $taskList = $taskBase->getContainer()->getModel()->findPage($ormResult1, $data['page'], $data['limit']);
        unset($ormResult1, $taskBase);

        $taskList['total_status'] = Project::$totalTaskStatus;
        $taskList['total_persisttypes'] = Project::$totalTaskPersistType;

        return $taskList;
    }

    public static function getTaskLogList(array $data) {
        $taskLog = SyTaskMysqlFactory::TaskLogEntity();
        $ormResult1 = $taskLog->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag`=?', [$data['task_tag']])->order('`created` DESC,`id` DESC');
        $logList = $taskLog->getContainer()->getModel()->findPage($ormResult1, $data['page'], $data['limit']);
        unset($ormResult1, $taskLog);

        return $logList;
    }
}