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
    public static $totalModuleName = [
        self::MODULE_NAME_API,
    ];
    public static $totalModuleBase = [
        self::MODULE_BASE_API,
    ];

    //REDIS常量 后五位字母+数字的前缀为项目前缀
    const REDIS_PREFIX_TIMER_QUEUE = 'sy' . SY_PROJECT . 'a0000_'; //前缀-定时器队列
    const REDIS_PREFIX_TIMER_CONTENT = 'sy' . SY_PROJECT . 'a0001_'; //前缀-定时器内容

    //任务常量
    const TASK_STATUS_DELETE = -1; //任务状态-已删除
    const TASK_STATUS_INVALID = 0; //任务状态-无效
    const TASK_STATUS_VALID = 1; //任务状态-有效
    const TASK_PERSIST_TYPE_SINGLE = 1; //持久化类型-单次
    const TASK_PERSIST_TYPE_INTERVAL = 2; //持久化类型-间隔时间
    const TASK_CACHE_EXPIRE_TIME = 300; //缓存过期时间-五分钟
    public static $totalTaskStatus = [
        self::TASK_STATUS_DELETE => '已删除',
        self::TASK_STATUS_INVALID => '无效',
        self::TASK_STATUS_VALID => '有效',
    ];
    public static $totalTaskPersistType = [
        self::TASK_PERSIST_TYPE_SINGLE => '单次任务',
        self::TASK_PERSIST_TYPE_INTERVAL => '间隔任务',
    ];

    //消息队列常量
    const MESSAGE_QUEUE_TOPIC_ADD_LOG = 'a000'; //主题-添加日志
    const MESSAGE_QUEUE_TOPIC_REQ_HEALTH_CHECK = 'a001'; //主题-请求健康检查
    const MESSAGE_QUEUE_TOPIC_TEST = SY_ENV . SY_PROJECT . '0000'; //主题-测试

    //服务预处理常量,标识长度为5位,第一位固定为/,后四位代表不同预处理操作,其中后四位全为数字的为框架内部预留标识
    const PRE_PROCESS_TAG_HTTP_PROJECT_REFRESH_TOKEN_EXPIRE = '/a000'; //HTTP服务项目标识-更新令牌过期时间
    const PRE_PROCESS_TAG_RPC_PROJECT_TEST = '/a000'; //RPC服务项目标识-测试

    //进程池服务标识常量,4位字符串,数字和字母组成,纯数字的为框架内部服务,其他为自定义服务
    const POOL_PROCESS_SERVICE_TAG_TEST = 'a000'; //服务标识-测试

    //消息处理常量
    public static $messageHandlerQueues = [
        self::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS => 'msga000',
        self::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS_PREVIEW => 'msga001',
        self::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS_ALL => 'msga002',
        self::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_TEMPLATE => 'msga003',
        self::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_TEMPLATE_SUBSCRIBE => 'msga004',
        self::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MESSAGE_CUSTOM => 'msga005',
        self::MESSAGE_HANDLER_TYPE_WX_CORP_CHAT => 'msga006',
        self::MESSAGE_HANDLER_TYPE_WX_CORP_MESSAGE => 'msga007',
        self::MESSAGE_HANDLER_TYPE_WX_CORP_MESSAGE_LINKED => 'msga008',
        self::MESSAGE_HANDLER_TYPE_WX_MINI_MESSAGE_CUSTOM => 'msga009',
        self::MESSAGE_HANDLER_TYPE_WX_MINI_TEMPLATE => 'msga010',
        self::MESSAGE_HANDLER_TYPE_DINGDING_CHAT => 'msga011',
        self::MESSAGE_HANDLER_TYPE_DINGDING_CONVERSATION => 'msga012',
        self::MESSAGE_HANDLER_TYPE_DINGDING_CONVERSATION_ASYNC => 'msga013',
        self::MESSAGE_HANDLER_TYPE_VOICE_ALIYUN_TTS => 'msga014',
        self::MESSAGE_HANDLER_TYPE_VOICE_ALIYUN_FILE => 'msga015',
        self::MESSAGE_HANDLER_TYPE_VOICE_QCLOUD_CODE => 'msga016',
        self::MESSAGE_HANDLER_TYPE_VOICE_QCLOUD_TEMPLATE => 'msga017',
        self::MESSAGE_HANDLER_TYPE_SMS_ALIYUN_SINGLE => 'msga018',
        self::MESSAGE_HANDLER_TYPE_SMS_ALIYUN_BATCH => 'msga019',
        self::MESSAGE_HANDLER_TYPE_SMS_DAYU => 'msga020',
        self::MESSAGE_HANDLER_TYPE_SMS_YUN253 => 'msga021',
    ];
}
