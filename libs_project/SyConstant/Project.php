<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/2 0002
 * Time: 11:30
 */
namespace SyConstant;

use SyTrait\SimpleTrait;

final class Project extends ProjectBase
{
    use SimpleTrait;

    //模块常量
    const MODULE_BASE_API = 'api';
    const MODULE_NAME_API = SY_PROJECT . self::MODULE_BASE_API;

    //REDIS常量 后五位字母+数字的前缀为项目前缀
    /**
     * redis-前缀-定时器队列
     */
    const REDIS_PREFIX_TIMER_QUEUE = 'sy' . SY_PROJECT . 'a0000_';
    /**
     * redis-前缀-定时器内容
     */
    const REDIS_PREFIX_TIMER_CONTENT = 'sy' . SY_PROJECT . 'a0001_';

    /**
     * 任务-状态-已删除
     */
    const TASK_STATUS_DELETE = -1;
    /**
     * 任务-状态-无效
     */
    const TASK_STATUS_INVALID = 0;
    /**
     * 任务-状态-有效
     */
    const TASK_STATUS_VALID = 1;
    /**
     * 任务-持久化类型-单次
     */
    const TASK_PERSIST_TYPE_SINGLE = 1;
    /**
     * 任务-持久化类型-间隔时间
     */
    const TASK_PERSIST_TYPE_INTERVAL = 2;
    /**
     * 任务-缓存过期时间-五分钟
     */
    const TASK_CACHE_EXPIRE_TIME = 300;

    /**
     * 消息队列-主题-添加日志
     */
    const MESSAGE_QUEUE_TOPIC_ADD_LOG = 'a000';
    /**
     * 消息队列-主题-请求健康检查
     */
    const MESSAGE_QUEUE_TOPIC_REQ_HEALTH_CHECK = 'a001';
    /**
     * 消息队列-主题-测试
     */
    const MESSAGE_QUEUE_TOPIC_TEST = SY_ENV . SY_PROJECT . '0000';

    //服务预处理常量,标识长度为5位,第一位固定为/,后四位代表不同预处理操作,其中后四位全为数字的为框架内部预留标识
    /**
     * 服务预处理-HTTP服务项目标识-更新令牌过期时间
     */
    const PRE_PROCESS_TAG_HTTP_PROJECT_REFRESH_TOKEN_EXPIRE = '/a000';
    /**
     * 服务预处理-RPC服务项目标识-测试
     */
    const PRE_PROCESS_TAG_RPC_PROJECT_TEST = '/a000';

    //进程池服务标识常量,4位字符串,数字和字母组成,纯数字的为框架内部服务,其他为自定义服务
    /**
     * 进程池-服务标识-测试
     */
    const POOL_PROCESS_SERVICE_TAG_TEST = 'a000';

    public static $totalModuleName = [
        self::MODULE_NAME_API,
    ];
    public static $totalModuleBase = [
        self::MODULE_BASE_API,
    ];
    public static $totalTaskStatus = [
        self::TASK_STATUS_DELETE => '已删除',
        self::TASK_STATUS_INVALID => '无效',
        self::TASK_STATUS_VALID => '有效',
    ];
    public static $totalTaskPersistType = [
        self::TASK_PERSIST_TYPE_SINGLE => '单次任务',
        self::TASK_PERSIST_TYPE_INTERVAL => '间隔任务',
    ];
}
