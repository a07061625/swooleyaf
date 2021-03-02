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
    const MODULE_BASE_ORDER = 'order';
    const MODULE_BASE_CONTENT = 'content';
    const MODULE_BASE_USER = 'user';
    const MODULE_BASE_SERVICE = 'services';
    const MODULE_NAME_API = SY_PROJECT . self::MODULE_BASE_API;
    const MODULE_NAME_ORDER = SY_PROJECT . self::MODULE_BASE_ORDER;
    const MODULE_NAME_CONTENT = SY_PROJECT . self::MODULE_BASE_CONTENT;
    const MODULE_NAME_USER = SY_PROJECT . self::MODULE_BASE_USER;
    const MODULE_NAME_SERVICE = SY_PROJECT . self::MODULE_BASE_SERVICE;

    //REDIS常量 后五位字母+数字的前缀为项目前缀
    /**
     * redis-前缀-验证码图片
     */
    const REDIS_PREFIX_CODE_IMAGE = self::REDIS_PREFIX_COMMON . 'a0000_';
    /**
     * redis-前缀-图片缓存
     */
    const REDIS_PREFIX_IMAGE_DATA = self::REDIS_PREFIX_COMMON . 'a0001_';
    /**
     * redis-前缀-支付哈希
     */
    const REDIS_PREFIX_PAY_HASH = self::REDIS_PREFIX_COMMON . 'a00002_';
    /**
     * redis-前缀-微信扫码预支付
     */
    const REDIS_PREFIX_WX_NATIVE_PRE = self::REDIS_PREFIX_COMMON . 'a0003_';
    /**
     * redis-前缀-im管理账号缓存
     */
    const REDIS_PREFIX_IM_ADMIN = self::REDIS_PREFIX_COMMON . 'a0004_';
    /**
     * redis-前缀-角色权限
     */
    const REDIS_PREFIX_PERMISSION_ROLE = self::REDIS_PREFIX_COMMON . 'a0005_';
    /**
     * redis-前缀-用户权限
     */
    const REDIS_PREFIX_PERMISSION_USER = self::REDIS_PREFIX_COMMON . 'a0006_';
    /**
     * redis-前缀-地区缓存
     */
    const REDIS_PREFIX_REGION_LIST = self::REDIS_PREFIX_COMMON . 'a0007_';
    /**
     * redis-前缀-框架令牌缓存
     */
    const REDIS_PREFIX_SY_TOKEN = self::REDIS_PREFIX_COMMON . 'a0008_';

    /**
     * 消息队列-主题-添加日志
     */
    const MESSAGE_QUEUE_TOPIC_ADD_LOG = '0000';
    /**
     * 消息队列-主题-请求健康检查
     */
    const MESSAGE_QUEUE_TOPIC_REQ_HEALTH_CHECK = '0001';
    /**
     * 消息队列-主题-测试
     */
    const MESSAGE_QUEUE_TOPIC_TEST = '0002';

    /**
     * 支付-方式-微信
     */
    const PAY_WAY_WX = 1;
    /**
     * 支付-方式-支付宝
     */
    const PAY_WAY_ALI = 2;
    /**
     * 支付-类型-微信公众号js支付
     */
    const PAY_TYPE_WX_ACCOUNT_JS = 'a000';
    /**
     * 支付-类型-微信公众号动态扫码支付
     */
    const PAY_TYPE_WX_ACCOUNT_NATIVE_DYNAMIC = 'a001';
    /**
     * 支付-类型-微信公众号静态扫码支付
     */
    const PAY_TYPE_WX_ACCOUNT_NATIVE_STATIC = 'a002';
    /**
     * 支付-类型-微信小程序js支付
     */
    const PAY_TYPE_WX_MINI_JS = 'a003';
    /**
     * 支付-类型-支付宝扫码支付
     */
    const PAY_TYPE_ALI_CODE = 'a100';
    /**
     * 支付-类型-支付宝网页支付
     */
    const PAY_TYPE_ALI_WEB = 'a101';

    /**
     * 订单-支付类型-商品
     */
    const ORDER_PAY_TYPE_GOODS = '1000';
    /**
     * 订单-退款类型-商品
     */
    const ORDER_REFUND_TYPE_GOODS = '5000';

    /**
     * 地区-类型-省
     */
    const REGION_LEVEL_TYPE_PROVINCE = 1;
    /**
     * 地区-类型-市
     */
    const REGION_LEVEL_TYPE_CITY = 2;
    /**
     * 地区-类型-县
     */
    const REGION_LEVEL_TYPE_COUNTY = 3;

    /**
     * 角色-状态-已删除
     */
    const ROLE_STATUS_DELETE = -1;
    /**
     * 角色-状态-无效
     */
    const ROLE_STATUS_INVALID = 0;
    /**
     * 角色-状态-有效
     */
    const ROLE_STATUS_VALID = 1;

    /**
     * 权限-层级-第一级
     */
    const PERMISSION_LEVEL_ONE = 1;
    /**
     * 权限-层级-第二级
     */
    const PERMISSION_LEVEL_TWO = 2;
    /**
     * 权限-层级-第三级
     */
    const PERMISSION_LEVEL_THREE = 3;
    /**
     * 权限-节点类型-树杈
     */
    const PERMISSION_NODE_TYPE_FORK = 1;
    /**
     * 权限-节点类型-叶子
     */
    const PERMISSION_NODE_TYPE_LEAF = 2;

    /**
     * 登录-类型-手机号码
     */
    const LOGIN_TYPE_PHONE = 'a000';
    /**
     * 登录-类型-邮箱
     */
    const LOGIN_TYPE_EMAIL = 'a001';
    /**
     * 登录-类型-账号
     */
    const LOGIN_TYPE_ACCOUNT = 'a002';
    /**
     * 登录-类型-微信静默授权
     */
    const LOGIN_TYPE_WX_AUTH_BASE = 'a100';
    /**
     * 登录-类型-微信手动授权
     */
    const LOGIN_TYPE_WX_AUTH_USER = 'a101';
    /**
     * 登录-类型-微信扫码
     */
    const LOGIN_TYPE_WX_SCAN = 'a102';
    /**
     * 登录-类型-QQ
     */
    const LOGIN_TYPE_QQ = 'a200';

    /**
     * 微信小程序-类型-平台小程序
     */
    const WXMINI_TYPE_PLAT_MINI = 1;
    /**
     * 微信小程序-类型-商户小程序
     */
    const WXMINI_TYPE_SHOP_MINI = 2;
    /**
     * 微信小程序-审核状态-未提交审核
     */
    const WXMINI_AUDIT_STATUS_UNDO = -1;
    /**
     * 微信小程序-审核状态-审核成功
     */
    const WXMINI_AUDIT_STATUS_SUCCESS = 0;
    /**
     * 微信小程序-审核状态-审核失败
     */
    const WXMINI_AUDIT_STATUS_FAIL = 1;
    /**
     * 微信小程序-审核状态-审核中
     */
    const WXMINI_AUDIT_STATUS_HANDING = 2;
    /**
     * 微信小程序-操作状态-未上传
     */
    const WXMINI_OPTION_STATUS_UN_UPLOAD = 1;
    /**
     * 微信小程序-操作状态-已上传
     */
    const WXMINI_OPTION_STATUS_UPLOADED = 2;
    /**
     * 微信小程序-操作状态-审核中
     */
    const WXMINI_OPTION_STATUS_APPLY_AUDIT = 3;
    /**
     * 微信小程序-操作状态-审核成功
     */
    const WXMINI_OPTION_STATUS_AUDIT_SUCCESS = 4;
    /**
     * 微信小程序-操作状态-审核失败
     */
    const WXMINI_OPTION_STATUS_AUDIT_FAIL = 5;
    /**
     * 微信小程序-操作状态-已发布
     */
    const WXMINI_OPTION_STATUS_RELEASED = 6;
    /**
     * 微信小程序-token超时时间,单位为秒
     */
    const WXMINI_EXPIRE_TOKEN = 7000;
    /**
     * 微信小程序-默认客户端IP
     */
    const WXMINI_DEFAULT_CLIENT_IP = '127.0.0.1';

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
        self::MODULE_NAME_ORDER,
        self::MODULE_NAME_CONTENT,
        self::MODULE_NAME_USER,
        self::MODULE_NAME_SERVICE,
    ];
    public static $totalModuleBase = [
        self::MODULE_BASE_API,
        self::MODULE_BASE_ORDER,
        self::MODULE_BASE_CONTENT,
        self::MODULE_BASE_USER,
        self::MODULE_BASE_SERVICE,
    ];
    public static $totalRegionLevelType = [
        self::REGION_LEVEL_TYPE_PROVINCE => '省',
        self::REGION_LEVEL_TYPE_CITY => '市',
        self::REGION_LEVEL_TYPE_COUNTY => '县',
    ];
    public static $totalRoleStatus = [
        self::ROLE_STATUS_DELETE => '已删除',
        self::ROLE_STATUS_INVALID => '无效',
        self::ROLE_STATUS_VALID => '有效',
    ];
    public static $totalPermissionLevel = [
        self::PERMISSION_LEVEL_ONE => '第一级',
        self::PERMISSION_LEVEL_TWO => '第二级',
        self::PERMISSION_LEVEL_THREE => '第三级',
    ];
    public static $totalWxMiniType = [
        self::WXMINI_TYPE_PLAT_MINI => '平台小程序',
        self::WXMINI_TYPE_SHOP_MINI => '商户小程序',
    ];
    public static $totalWxMiniAuditStatus = [
        self::WXMINI_AUDIT_STATUS_UNDO => '未提交审核',
        self::WXMINI_AUDIT_STATUS_SUCCESS => '审核成功',
        self::WXMINI_AUDIT_STATUS_FAIL => '审核失败',
        self::WXMINI_AUDIT_STATUS_HANDING => '审核中',
    ];
    public static $totalWxMiniOptionStatus = [
        self::WXMINI_OPTION_STATUS_UN_UPLOAD => '未上传',
        self::WXMINI_OPTION_STATUS_UPLOADED => '已上传',
        self::WXMINI_OPTION_STATUS_APPLY_AUDIT => '审核中',
        self::WXMINI_OPTION_STATUS_AUDIT_SUCCESS => '审核成功',
        self::WXMINI_OPTION_STATUS_AUDIT_FAIL => '审核失败',
        self::WXMINI_OPTION_STATUS_RELEASED => '已发布',
    ];
}
