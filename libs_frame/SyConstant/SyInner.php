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

    /**
     * 服务-类型-api入口
     */
    const SERVER_TYPE_API_GATE = 'api';
    /**
     * 服务-类型-api模块
     */
    const SERVER_TYPE_API_MODULE = 'rpc';
    /**
     * 服务-类型-前端入口
     */
    const SERVER_TYPE_FRONT_GATE = 'frontgate';
    /**
     * 服务-http标识-请求头名称
     */
    const SERVER_HTTP_TAG_REQUEST_HEADER = 'swoole-yaf';
    /**
     * 服务-内部数据键名-task
     */
    const SERVER_DATA_KEY_TASK = '_sytask';
    /**
     * 服务-内部数据键名-请求时间戳
     */
    const SERVER_DATA_KEY_TIMESTAMP = 'SYREQ_TIME';
    /**
     * 服务-内部数据键名-http响应错误状态码
     */
    const SERVER_DATA_KEY_HTTP_RSP_CODE_ERROR = 'Syresp-Status';

    /**
     * 服务注册-类型-nginx
     */
    const SERVER_REGISTER_TYPE_NGINX = 'nginx';

    /**
     * 进程-类型-task
     */
    const PROCESS_TYPE_TASK = 'Task';
    /**
     * 进程-类型-worker
     */
    const PROCESS_TYPE_WORKER = 'Worker';
    /**
     * 进程-类型-manager
     */
    const PROCESS_TYPE_MANAGER = 'Manager';
    /**
     * 进程-类型-main
     */
    const PROCESS_TYPE_MAIN = 'Main';

    /**
     * 环境-项目-测试
     */
    const ENV_PROJECT_DEV = 'dev';
    /**
     * 环境-项目-生产
     */
    const ENV_PROJECT_PRODUCT = 'product';
    /**
     * 环境-系统-bsd
     */
    const ENV_SYSTEM_BSD = 'FreeBSD';
    /**
     * 环境-系统-mac
     */
    const ENV_SYSTEM_MAC = 'Darwin';
    /**
     * 环境-系统-linux
     */
    const ENV_SYSTEM_LINUX = 'Linux';
    /**
     * 环境-端口-最小
     */
    const ENV_PORT_MIN = 1024;
    /**
     * 环境-端口-最大
     */
    const ENV_PORT_MAX = 65535;
    /**
     * 环境-系统用户-root
     */
    const SYSTEM_USER_ROOT = 'root';

    /**
     * 版本-最低-php
     */
    const VERSION_MIN_PHP = '7.2.0';
    /**
     * 版本-最低-swoole,测试发现4.5.3-4.5.5在启动服务时候会发生诡异的问题,没有日志信息,但是只能启动api模块
     */
    const VERSION_MIN_SWOOLE = '4.5.2';
    /**
     * 版本-最低-seaslog
     */
    const VERSION_MIN_SEASLOG = '2.1.0';
    /**
     * 版本-最低-yac
     */
    const VERSION_MIN_YAC = '2.2.0';
    /**
     * 版本-最低-yaf
     */
    const VERSION_MIN_YAF = '3.2.1';
    /**
     * 版本-最低-runkit
     */
    const VERSION_MIN_RUNKIT = '3.0.0';
    /**
     * 版本-最低-redis
     */
    const VERSION_MIN_REDIS = '5.0.0';

    /**
     * 熔断器-状态-开启
     */
    const FUSE_STATE_OPEN = 'open';
    /**
     * 熔断器-状态-关闭
     */
    const FUSE_STATE_CLOSED = 'closed';
    /**
     * 熔断器-状态-半开
     */
    const FUSE_STATE_HALF_OPEN = 'half_open';
    /**
     * 熔断器-错误统计间隔时间,单位为秒
     */
    const FUSE_TIME_ERROR_STAT = 15;
    /**
     * 熔断器-开启状态保持时间,单位为秒
     */
    const FUSE_TIME_OPEN_KEEP = 10;
    /**
     * 熔断器-请求出错次数
     */
    const FUSE_NUM_REQUEST_ERROR = 20;
    /**
     * 熔断器-半开状态请求成功次数
     */
    const FUSE_NUM_HALF_REQUEST_SUCCESS = 10;
    /**
     * 熔断器-请求出错提示消息
     */
    const FUSE_MSG_REQUEST_ERROR = '{"code":10001,"data":[],"msg":"服务繁忙,请稍后重试"}';

    /**
     * 路由-类型-简单路由
     */
    const ROUTE_TYPE_SIMPLE = 'simple';

    /**
     * 注册-名称-服务错误
     */
    const REGISTRY_NAME_SERVICE_ERROR = 'SERVICE_ERROR';
    /**
     * 注册-名称-请求头
     */
    const REGISTRY_NAME_REQUEST_HEADER = 'REQUEST_HEADER';
    /**
     * 注册-名称-服务器信息
     */
    const REGISTRY_NAME_REQUEST_SERVER = 'REQUEST_SERVER';
    /**
     * 注册-名称-响应头
     */
    const REGISTRY_NAME_RESPONSE_HEADER = 'RESPONSE_HEADER';
    /**
     * 注册-名称-响应cookie
     */
    const REGISTRY_NAME_RESPONSE_COOKIE = 'RESPONSE_COOKIE';
    /**
     * 注册-名称-响应jwt会话
     */
    const REGISTRY_NAME_RESPONSE_JWT_SESSION = 'RESPONSE_JWT_SESSION';
    /**
     * 注册-名称-响应jwt数据
     */
    const REGISTRY_NAME_RESPONSE_JWT_DATA = 'RESPONSE_JWT_DATA';
    /**
     * 注册-名称前缀-校验器
     */
    const REGISTRY_NAME_PREFIX_VALIDATOR = 'VALIDATOR_';
    /**
     * 注册-名称前缀-控制器
     */
    const REGISTRY_NAME_PREFIX_CONTROLLER = 'CONTROLLER_';
    /**
     * 注册-名称前缀-前置切面
     */
    const REGISTRY_NAME_PREFIX_ASPECT_BEFORE = 'ASPECTBEFORE_';
    /**
     * 注册-名称前缀-后置切面
     */
    const REGISTRY_NAME_PREFIX_ASPECT_AFTER = 'ASPECTAFTER_';

    /**
     * 图片-MIME类型-PNG
     */
    const IMAGE_MIME_TYPE_PNG = 'image/png';
    /**
     * 图片-MIME类型-JPEG
     */
    const IMAGE_MIME_TYPE_JPEG = 'image/jpeg';
    /**
     * 图片-MIME类型-GIF
     */
    const IMAGE_MIME_TYPE_GIF = 'image/gif';
    /**
     * 图片-噪点滤镜类型-扩散
     */
    const IMAGE_FILTER_DITHER_DIFFUSION = 'diffusion';
    /**
     * 图片-噪点滤镜类型-规整
     */
    const IMAGE_FILTER_DITHER_ORDERED = 'ordered';
    /**
     * 图片-数据类型-binary
     */
    const IMAGE_DATA_TYPE_BINARY = 'binary';
    /**
     * 图片-数据类型-base64
     */
    const IMAGE_DATA_TYPE_BASE64 = 'base64';

    /**
     * 注解-名称-数据校验器
     */
    const ANNOTATION_NAME_FILTER = 'SyFilter';
    /**
     * 注解-名称-环绕切面
     */
    const ANNOTATION_NAME_ASPECT = 'SyAspect';
    /**
     * 注解-名称-前置切面
     */
    const ANNOTATION_NAME_ASPECT_BEFORE = 'SyAspectBefore';
    /**
     * 注解-名称-后置切面
     */
    const ANNOTATION_NAME_ASPECT_AFTER = 'SyAspectAfter';
    /**
     * 注解-标识-管理控制
     */
    const ANNOTATION_TAG_SY_MANAGER = '__symanager';

    /**
     * 支付-贝宝支付环境-正式
     */
    const PAY_PAYPAL_ENV_PRODUCT = 'product';
    /**
     * 支付-贝宝支付环境-沙箱
     */
    const PAY_PAYPAL_ENV_SANDBOX = 'sandbox';

    public static $totalServerType = [
        self::SERVER_TYPE_API_GATE => 'api入口',
        self::SERVER_TYPE_API_MODULE => 'api模块',
        self::SERVER_TYPE_FRONT_GATE => '前端入口',
    ];
    public static $totalServerRegisterType = [
        self::SERVER_REGISTER_TYPE_NGINX => 1,
    ];
    public static $totalEnvProject = [
        self::ENV_PROJECT_DEV,
        self::ENV_PROJECT_PRODUCT,
    ];
    public static $totalEnvSystem = [
        self::ENV_SYSTEM_BSD,
        self::ENV_SYSTEM_MAC,
        self::ENV_SYSTEM_LINUX,
    ];
    public static $totalImageFilterDither = [
        self::IMAGE_FILTER_DITHER_ORDERED,
        self::IMAGE_FILTER_DITHER_DIFFUSION,
    ];
}
