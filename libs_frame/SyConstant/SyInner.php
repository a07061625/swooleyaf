<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/12 0012
 * Time: 9:30
 */
namespace SyConstant;

use SyTrait\SimpleTrait;

final class SyInner
{
    use SimpleTrait;
    const SERVER_TYPE_API_GATE = 'api'; //服务端类型-api入口
    const SERVER_TYPE_API_MODULE = 'rpc'; //服务端类型-api模块
    const SERVER_TYPE_FRONT_GATE = 'frontgate'; //服务端类型-前端入口
    const SERVER_HTTP_TAG_REQUEST_HEADER = 'swoole-yaf'; //服务端http标识-请求头名称
    const SERVER_DATA_KEY_TASK = '_sytask'; //服务端内部数据键名-task
    const SERVER_DATA_KEY_TIMESTAMP = 'SYREQ_TIME'; //服务端内部数据键名-请求时间戳
    const SERVER_DATA_KEY_HTTP_RSP_CODE_ERROR = 'Syresp-Status'; //服务端内部数据键名-http响应错误状态码

    //进程常量
    const PROCESS_TYPE_TASK = 'Task'; //类型-task
    const PROCESS_TYPE_WORKER = 'Worker'; //类型-worker
    const PROCESS_TYPE_MANAGER = 'Manager'; //类型-manager
    const PROCESS_TYPE_MAIN = 'Main'; //类型-main
    const ENV_PROJECT_DEV = 'dev'; //项目环境-测试
    const ENV_PROJECT_PRODUCT = 'product'; //项目环境-生产
    const ENV_SYSTEM_BSD = 'FreeBSD'; //系统环境-bsd
    const ENV_SYSTEM_MAC = 'Darwin'; //系统环境-mac
    const ENV_SYSTEM_LINUX = 'Linux'; //系统环境-linux
    const ENV_PORT_MIN = 1024; //端口-最小
    const ENV_PORT_MAX = 65535; //端口-最大
    const SYSTEM_USER_ROOT = 'root'; //系统用户-root

    //版本常量
    const VERSION_MIN_PHP = '7.1.0'; //最低版本-php
    const VERSION_MIN_SWOOLE = '4.3.2'; //最低版本-swoole
    const VERSION_MIN_SEASLOG = '1.9.0'; //最低版本-seaslog
    const VERSION_MIN_YAC = '2.0.2'; //最低版本-yac
    const VERSION_MIN_YAF = '3.0.7'; //最低版本-yaf
    const VERSION_MIN_RUNKIT = '3.0.0'; //最低版本-runkit

    //熔断器常量
    const FUSE_STATE_OPEN = 'open'; //状态-开启
    const FUSE_STATE_CLOSED = 'closed'; //状态-关闭
    const FUSE_STATE_HALF_OPEN = 'half_open'; //状态-半开
    const FUSE_TIME_ERROR_STAT = 15; //错误统计间隔时间,单位为秒
    const FUSE_TIME_OPEN_KEEP = 10; //开启状态保持时间,单位为秒
    const FUSE_NUM_REQUEST_ERROR = 20; //请求出错次数
    const FUSE_NUM_HALF_REQUEST_SUCCESS = 10; //半开状态请求成功次数
    const FUSE_MSG_REQUEST_ERROR = '{"code":10001,"data":[],"msg":"服务繁忙,请稍后重试"}'; //请求出错提示消息

    //路由常量
    const ROUTE_TYPE_SIMPLE = 'simple'; //类型-简单路由

    //注册常量
    const REGISTRY_NAME_SERVICE_ERROR = 'SERVICE_ERROR'; //名称-服务错误
    const REGISTRY_NAME_REQUEST_HEADER = 'REQUEST_HEADER'; //名称-请求头
    const REGISTRY_NAME_REQUEST_SERVER = 'REQUEST_SERVER'; //名称-服务器信息
    const REGISTRY_NAME_RESPONSE_HEADER = 'RESPONSE_HEADER'; //名称-响应头
    const REGISTRY_NAME_RESPONSE_COOKIE = 'RESPONSE_COOKIE'; //名称-响应cookie
    const REGISTRY_NAME_RESPONSE_JWT_SESSION = 'RESPONSE_JWT_SESSION'; //名称-响应jwt会话
    const REGISTRY_NAME_RESPONSE_JWT_DATA = 'RESPONSE_JWT_DATA'; //名称-响应jwt数据
    const REGISTRY_NAME_PREFIX_VALIDATOR = 'VALIDATOR_'; //名称前缀-校验器
    const REGISTRY_NAME_PREFIX_CONTROLLER = 'CONTROLLER_'; //名称前缀-控制器
    const REGISTRY_NAME_PREFIX_ASPECT_BEFORE = 'ASPECTBEFORE_'; //名称前缀-前置切面
    const REGISTRY_NAME_PREFIX_ASPECT_AFTER = 'ASPECTAFTER_'; //名称前缀-后置切面
    const IMAGE_MIME_TYPE_PNG = 'image/png'; //MIME类型-PNG
    const IMAGE_MIME_TYPE_JPEG = 'image/jpeg'; //MIME类型-JPEG
    const IMAGE_MIME_TYPE_GIF = 'image/gif'; //MIME类型-GIF
    const IMAGE_FILTER_DITHER_DIFFUSION = 'diffusion'; //噪点滤镜类型-扩散
    const IMAGE_FILTER_DITHER_ORDERED = 'ordered'; //噪点滤镜类型-规整

    //注解常量
    public static $annotationSignTags = [
        self::ANNOTATION_TAG_SIGN => 1,
        self::ANNOTATION_TAG_IGNORE_SIGN => 1,
        self::ANNOTATION_TAG_IGNORE_JWT => 1,
    ];
    const ANNOTATION_NAME_FILTER = 'SyFilter'; //名称-数据校验器
    const ANNOTATION_NAME_ASPECT = 'SyAspect'; //名称-环绕切面
    const ANNOTATION_NAME_ASPECT_BEFORE = 'SyAspectBefore'; //名称-前置切面
    const ANNOTATION_NAME_ASPECT_AFTER = 'SyAspectAfter'; //名称-后置切面
    const ANNOTATION_TAG_SIGN = '_sign'; //标识-接口签名
    const ANNOTATION_TAG_IGNORE_SIGN = '_ignoresign'; //标识-取消接口签名
    const ANNOTATION_TAG_IGNORE_JWT = '_ignorejwt'; //标识-取消jwt校验
    const ANNOTATION_TAG_SY_TOKEN = '__sytoken'; //标识-框架令牌
    const ANNOTATION_TAG_SESSION_JWT = '__sessionjwt'; //标识-JWT会话

    //服务常量
    public static $totalServerType = [
        self::SERVER_TYPE_API_GATE => 'api入口',
        self::SERVER_TYPE_API_MODULE => 'api模块',
        self::SERVER_TYPE_FRONT_GATE => '前端入口',
    ];

    //环境常量
    public static $totalEnvProject = [
        self::ENV_PROJECT_DEV,
        self::ENV_PROJECT_PRODUCT,
    ];
    public static $totalEnvSystem = [
        self::ENV_SYSTEM_BSD,
        self::ENV_SYSTEM_MAC,
        self::ENV_SYSTEM_LINUX,
    ];

    //图片常量
    public static $totalImageFilterDither = [
        self::IMAGE_FILTER_DITHER_ORDERED,
        self::IMAGE_FILTER_DITHER_DIFFUSION,
    ];
}
