<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/12 0012
 * Time: 9:30
 */
namespace Constant;

use Traits\SimpleTrait;

final class Server {
    use SimpleTrait;

    //服务常量
    const SERVER_PACKAGE_MAX_LENGTH = 12582912; //服务端消息最大长度-12M
    const SERVER_OUTPUT_MAX_LENGTH = 5242880; //服务端输出内容最大长度-5M
    const SERVER_TYPE_API = 'api'; //服务端类型-api
    const SERVER_TYPE_RPC = 'rpc'; //服务端类型-rpc
    const SERVER_HTTP_TAG_RESPONSE_EOF = "\r\r\rswoole@yaf\r\r\r"; //服务端http标识-响应结束符
    const SERVER_HTTP_TAG_REQUEST_HEADER = 'swoole-yaf'; //服务端http标识-请求头名称
    const SERVER_DATA_KEY_TASK = '_sytask'; //服务端内部数据键名-task
    const SERVER_DATA_KEY_TIMESTAMP = 'SYREQ_TIME'; //服务端内部数据键名-请求时间戳
    const SERVER_TIME_REQ_HANDLE_MAX = 120; //服务端时间-请求最大执行时间,单位为毫秒
    const SERVER_TIME_REQ_HEALTH_MIN = 4000; //服务端时间-请求健康检查最小时间,单位为毫秒

    //进程常量
    const PROCESS_TYPE_TASK = 'Task'; //类型-task
    const PROCESS_TYPE_WORKER = 'Worker'; //类型-worker
    const PROCESS_TYPE_MANAGER = 'Manager'; //类型-manager
    const PROCESS_TYPE_MAIN = 'Main'; //类型-main

    //环境常量
    public static $totalEnvProject = [
        self::ENV_PROJECT_DEV,
        self::ENV_PROJECT_PRODUCT,
    ];
    public static $totalEnvSystem = [
        self::ENV_SYSTEM_BSD,
        self::ENV_SYSTEM_LINUX,
    ];
    const ENV_PROJECT_DEV = 'dev'; //项目环境-测试
    const ENV_PROJECT_PRODUCT = 'product'; //项目环境-生产
    const ENV_SYSTEM_BSD = 'FreeBSD'; //系统环境-bsd
    const ENV_SYSTEM_LINUX = 'Linux'; //系统环境-linux

    //版本常量
    const VERSION_MIN_PHP = '7.1.0'; //最低版本-php
    const VERSION_MIN_SWOOLE = '4.1.0'; //最低版本-swoole

    //YAC常量,以0000开头的前缀为框架内部前缀,并键名总长度不超过48个字符串
    const YAC_PREFIX_FUSE = '0000'; //前缀-熔断器

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
    const ROUTE_TYPE_BASIC = 'basic'; //类型-基础路由

    //注册常量
    const REGISTRY_NAME_SERVICE_ERROR = 'SERVICE_ERROR'; //名称-服务错误
    const REGISTRY_NAME_REQUEST_HEADER = 'REQUEST_HEADER'; //名称-请求头
    const REGISTRY_NAME_REQUEST_SERVER = 'REQUEST_SERVER'; //名称-服务器信息
    const REGISTRY_NAME_RESPONSE_HEADER = 'RESPONSE_HEADER'; //名称-响应头
    const REGISTRY_NAME_RESPONSE_COOKIE = 'RESPONSE_COOKIE'; //名称-响应cookie

    //图片常量
    public static $totalImageFilterDither = [
        self::IMAGE_FILTER_DITHER_ORDERED,
        self::IMAGE_FILTER_DITHER_DIFFUSION,
    ];
    const IMAGE_MIME_TYPE_PNG = 'image/png'; //MIME类型-PNG
    const IMAGE_MIME_TYPE_JPEG = 'image/jpeg'; //MIME类型-JPEG
    const IMAGE_MIME_TYPE_GIF = 'image/gif'; //MIME类型-GIF
    const IMAGE_FILTER_DITHER_DIFFUSION = 'diffusion'; //噪点滤镜类型-扩散
    const IMAGE_FILTER_DITHER_ORDERED = 'ordered'; //噪点滤镜类型-规整
}
