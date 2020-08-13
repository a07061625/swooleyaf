<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/1 0001
 * Time: 15:02
 */
namespace SyConstant;

use SyTrait\SimpleTrait;

class ProjectBase
{
    use SimpleTrait;

    //数据常量
    const DATA_KEY_SESSION_TOKEN = 'sytoken'; //键名-session标识
    const DATA_KEY_CACHE_UNIQUE_ID = self::REDIS_PREFIX_UNIQUE_ID . 'uniqueid'; //键名-缓存唯一ID
    const DATA_KEY_LANGUAGE_TAG = '_sylang'; //键名-语言标识
    const DATA_KEY_SIGN_PARAMS = '_sign'; //键名-请求参数签名字段
    const DATA_KEY_SIGN_HEADER = 'sy-sign'; //键名-请求头签名字段
    const DATA_KEY_FORMAT_HEADER = 'sy-format'; //键名-请求头数据格式字段
    const DATA_KEY_DOMAIN_COOKIE_HEADER = 'sydomain-cookie'; //键名-请求头cookie域名字段
    const DATA_KEY_DOMAIN_COOKIE_SERVER = 'SyDomain-Cookie'; //键名-$_SERVER中cookie域名字段
    const DATA_KEY_RESPONSE_CONTENT_HEADERS = '_syresp_headers'; //键名-响应内容响应头字段
    const DATA_KEY_RESPONSE_CONTENT_COOKIES = '_syresp_cookies'; //键名-响应内容响应cookie字段
    const DATA_KEY_RESPONSE_CONTENT_STRING = '_syresp_string'; //键名-响应内容字符串字段,用于支付宝支付回调等需要返回字符串的需求

    //公共常量
    const COMMON_PAGE_DEFAULT = 1; //默认页数
    const COMMON_LIMIT_DEFAULT = 10; //默认分页限制

    //REDIS常量 后五位全数字的前缀为框架内部前缀,微信:10000-14999 支付宝:15000-19999
    const REDIS_PREFIX_SESSION = 'sy' . SY_PROJECT . '00001_'; //前缀-session
    const REDIS_PREFIX_SESSION_JWT_REFRESH = 'sy' . SY_PROJECT . '00002_'; //前缀-会话JWT更新
    const REDIS_PREFIX_UNIQUE_ID = 'sy' . SY_PROJECT . '00003_'; //前缀-唯一ID
    const REDIS_PREFIX_WX_ACCOUNT = 'sy' . SY_PROJECT . '10000_'; //前缀-微信公众号
    const REDIS_PREFIX_WX_COMPONENT_ACCOUNT = 'sy' . SY_PROJECT . '10001_'; //前缀-微信开放平台账号
    const REDIS_PREFIX_WX_COMPONENT_AUTHORIZER = 'sy' . SY_PROJECT . '10002_'; //前缀-微信开放平台授权公众号
    const REDIS_PREFIX_WX_COMPONENT_AUTHORIZER_CODE_SECRET = 'sy' . SY_PROJECT . '10003_'; //前缀-微信开放平台授权小程序代码保护密钥
    const REDIS_PREFIX_WX_CORP = 'sy' . SY_PROJECT . '10100_'; //前缀-企业微信
    const REDIS_PREFIX_WX_PROVIDER_CORP_ACCOUNT = 'sy' . SY_PROJECT . '10101_'; //前缀-企业微信服务商账号
    const REDIS_PREFIX_WX_PROVIDER_CORP_ACCOUNT_SUITE = 'sy' . SY_PROJECT . '10102_'; //前缀-企业微信服务商套件
    const REDIS_PREFIX_WX_PROVIDER_CORP_AUTHORIZER = 'sy' . SY_PROJECT . '10103_'; //前缀-服务商授权企业微信
    const REDIS_PREFIX_MESSAGE_QUEUE = 'sy' . SY_PROJECT . '20000_'; //前缀-消息队列
    const REDIS_PREFIX_MESSAGE_KAFKA_OFFSET = 'sy' . SY_PROJECT . '20001_'; //前缀-kafka消息位移缓存
    const REDIS_PREFIX_PRINT_FEYIN_ACCOUNT = 'sy' . SY_PROJECT . '20100_'; //前缀-飞印打印账号
    const REDIS_PREFIX_DINGTALK_CORP = 'sy' . SY_PROJECT . '20200_'; //前缀-企业钉钉
    const REDIS_PREFIX_DINGTALK_PROVIDER_ACCOUNT = 'sy' . SY_PROJECT . '20201_'; //前缀-企业钉钉服务商账号
    const REDIS_PREFIX_DINGTALK_PROVIDER_ACCOUNT_SUITE = 'sy' . SY_PROJECT . '20202_'; //前缀-企业钉钉服务商套件
    const REDIS_PREFIX_DINGTALK_PROVIDER_AUTHORIZER = 'sy' . SY_PROJECT . '20203_'; //前缀-服务商授权企业钉钉
    const REDIS_PREFIX_JPUSH_APP_CID_PUSH = 'sy' . SY_PROJECT . '20300_'; //前缀-极光推送推送唯一标识符
    const REDIS_PREFIX_JPUSH_APP_CID_SCHEDULE = 'sy' . SY_PROJECT . '20301_'; //前缀-极光推送定时任务唯一标识符
    const REDIS_PREFIX_CODE_WEBHOOK_QUEUE = 'sy' . SY_PROJECT . '20400_'; //前缀-代码WebHook队列
    const REDIS_PREFIX_CODE_WEBHOOK_STATUS = 'sy' . SY_PROJECT . '20401_'; //前缀-代码WebHook状态
    const REDIS_PREFIX_CODE_WEBHOOK_COMMAND = 'sy' . SY_PROJECT . '20402_'; //前缀-代码WebHook命令
    const REDIS_PREFIX_CODE_WEBHOOK_INFO = 'sy' . SY_PROJECT . '20403_'; //前缀-代码WebHook信息
    const REDIS_PREFIX_LIVE_EDUCATION_BJY = 'sy' . SY_PROJECT . '20500_'; //前缀-百家云教育直播
    const REDIS_PREFIX_MESSAGE_HANDLER_TOPIC = 'sy' . SY_PROJECT . '20600_'; //前缀-消息处理主题

    //YAC常量,以0000开头的前缀为框架内部前缀,并键名总长度不超过48个字符串
    const YAC_PREFIX_FUSE = '0000'; //前缀-熔断器
    const YAC_PREFIX_API_SIGN = '0001'; //前缀-接口签名

    //校验器常量
    const VALIDATOR_STRING_TYPE_REQUIRED = 'string_required'; //字符串类型-必填
    const VALIDATOR_STRING_TYPE_MIN = 'string_min'; //字符串类型-最小长度
    const VALIDATOR_STRING_TYPE_MAX = 'string_max'; //字符串类型-最大长度
    const VALIDATOR_STRING_TYPE_REGEX = 'string_regex'; //字符串类型-正则表达式
    const VALIDATOR_STRING_TYPE_PHONE = 'string_phone'; //字符串类型-手机号码
    const VALIDATOR_STRING_TYPE_TEL = 'string_tel'; //字符串类型-联系方式
    const VALIDATOR_STRING_TYPE_EMAIL = 'string_email'; //字符串类型-邮箱
    const VALIDATOR_STRING_TYPE_URL = 'string_url'; //字符串类型-URL链接
    const VALIDATOR_STRING_TYPE_JSON = 'string_json'; //字符串类型-JSON
    const VALIDATOR_STRING_TYPE_SIGN = 'string_sign'; //字符串类型-请求签名
    const VALIDATOR_STRING_TYPE_BASE_IMAGE = 'string_baseimage'; //字符串类型-base64编码图片
    const VALIDATOR_STRING_TYPE_IP = 'string_ip'; //字符串类型-IP
    const VALIDATOR_STRING_TYPE_LNG = 'string_lng'; //字符串类型-经度
    const VALIDATOR_STRING_TYPE_LAT = 'string_lat'; //字符串类型-纬度
    const VALIDATOR_STRING_TYPE_NO_JS = 'string_nojs'; //字符串类型-不允许js脚本
    const VALIDATOR_STRING_TYPE_NO_EMOJI = 'string_noemoji'; //字符串类型-不允许emoji表情
    const VALIDATOR_STRING_TYPE_ZH = 'string_zh'; //字符串类型-中文,数字,字母
    const VALIDATOR_STRING_TYPE_ALNUM = 'string_alnum'; //字符串类型-数字,字母
    const VALIDATOR_STRING_TYPE_ALPHA = 'string_alpha'; //字符串类型-字母
    const VALIDATOR_STRING_TYPE_DIGIT = 'string_digit'; //字符串类型-数字
    const VALIDATOR_STRING_TYPE_LOWER = 'string_lower'; //字符串类型-小写字母
    const VALIDATOR_STRING_TYPE_UPPER = 'string_upper'; //字符串类型-大写字母
    const VALIDATOR_STRING_TYPE_DIGIT_LOWER = 'string_digitlower'; //字符串类型-数字,小写字母
    const VALIDATOR_STRING_TYPE_DIGIT_UPPER = 'string_digitupper'; //字符串类型-数字,大写字母
    const VALIDATOR_STRING_TYPE_SY_TOKEN = 'string_sytoken'; //字符串类型-框架令牌
    const VALIDATOR_STRING_TYPE_JWT = 'string_jwt'; //字符串类型-会话JWT
    const VALIDATOR_INT_TYPE_REQUIRED = 'int_required'; //整数类型-必填
    const VALIDATOR_INT_TYPE_MIN = 'int_min'; //整数类型-最小值
    const VALIDATOR_INT_TYPE_MAX = 'int_max'; //整数类型-最大值
    const VALIDATOR_INT_TYPE_IN = 'int_in'; //整数类型-取值枚举
    const VALIDATOR_INT_TYPE_BETWEEN = 'int_between'; //整数类型-取值区间
    const VALIDATOR_DOUBLE_TYPE_REQUIRED = 'double_required'; //浮点数类型-必填
    const VALIDATOR_DOUBLE_TYPE_MIN = 'double_min'; //浮点数类型-最小值
    const VALIDATOR_DOUBLE_TYPE_MAX = 'double_max'; //浮点数类型-最大值
    const VALIDATOR_DOUBLE_TYPE_BETWEEN = 'double_between'; //浮点数类型-取值区间

    //微信开放平台常量
    const WX_COMPONENT_AUTHORIZER_STATUS_CANCEL = 0; //授权公众号状态-取消授权
    const WX_COMPONENT_AUTHORIZER_STATUS_ALLOW = 1; //授权公众号状态-允许授权
    const WX_COMPONENT_AUTHORIZER_OPTION_TYPE_AUTHORIZED = 1; //授权公众号操作类型-允许授权
    const WX_COMPONENT_AUTHORIZER_OPTION_TYPE_UNAUTHORIZED = 2; //授权公众号操作类型-取消授权
    const WX_COMPONENT_AUTHORIZER_OPTION_TYPE_AUTHORIZED_UPDATE = 3; //授权公众号操作类型-更新授权

    //企业微信服务商常量
    const WX_PROVIDER_CORP_AUTHORIZER_STATUS_CANCEL = 0; //企业微信状态-取消授权
    const WX_PROVIDER_CORP_AUTHORIZER_STATUS_ALLOW = 1; //企业微信状态-允许授权
    const WX_PROVIDER_CORP_AUTHORIZER_OPTION_TYPE_AUTH_CREATE = 1; //企业微信操作类型-成功授权
    const WX_PROVIDER_CORP_AUTHORIZER_OPTION_TYPE_AUTH_CANCEL = 2; //企业微信操作类型-取消授权
    const WX_PROVIDER_CORP_AUTHORIZER_OPTION_TYPE_AUTH_CHANGE = 3; //企业微信操作类型-变更授权

    //微信配置常量
    const WX_CONFIG_STATUS_DISABLE = 0; //状态-无效
    const WX_CONFIG_STATUS_ENABLE = 1; //状态-有效
    const WX_CONFIG_AUTHORIZE_STATUS_EMPTY = -1; //第三方授权状态-不存在
    const WX_CONFIG_AUTHORIZE_STATUS_NO = 0; //第三方授权状态-未授权
    const WX_CONFIG_AUTHORIZE_STATUS_YES = 1; //第三方授权状态-已授权
    const WX_CONFIG_CORP_STATUS_DISABLE = 0; //企业微信状态-无效
    const WX_CONFIG_CORP_STATUS_ENABLE = 1; //企业微信状态-有效
    const WX_CONFIG_DEFAULT_CLIENT_IP = '127.0.0.1'; //默认客户端IP

    //支付宝支付常量
    const ALI_PAY_STATUS_DISABLE = 0; //状态-无效
    const ALI_PAY_STATUS_ENABLE = 1; //状态-有效

    //钉钉配置常量
    const DINGTALK_CONFIG_CORP_STATUS_DISABLE = 0; //企业钉钉状态-无效
    const DINGTALK_CONFIG_CORP_STATUS_ENABLE = 1; //企业钉钉状态-有效

    //本地缓存常量
    const LOCAL_CACHE_TAG_WX_ACCOUNT = '001'; //标识-微信账号
    const LOCAL_CACHE_TAG_WXOPEN_AUTHORIZER = '002'; //标识-微信开放平台授权者

    //时间常量
    const TIME_EXPIRE_LOCAL_USER_CACHE = 300; //超时时间-本地用户缓存,单位为秒
    const TIME_EXPIRE_LOCAL_API_SIGN_CACHE = 30; //超时时间-本地api签名缓存,单位为秒
    const TIME_EXPIRE_LOCAL_WXACCOUNT_REFRESH = 600; //超时时间-本地微信账号更新,单位为秒
    const TIME_EXPIRE_LOCAL_WXACCOUNT_CLEAR = 3600; //超时时间-本地微信账号清理,单位为秒
    const TIME_EXPIRE_LOCAL_WXCORP_REFRESH = 600; //超时时间-本地企业微信更新,单位为秒
    const TIME_EXPIRE_LOCAL_WXCORP_CLEAR = 3600; //超时时间-本地企业微信清理,单位为秒
    const TIME_EXPIRE_LOCAL_WXCACHE_CLEAR = 300; //超时时间-本地微信缓存清理,单位为秒
    const TIME_EXPIRE_LOCAL_ALIPAY_REFRESH = 600; //超时时间-本地支付宝支付更新,单位为秒
    const TIME_EXPIRE_LOCAL_ALIPAY_CLEAR = 3600; //超时时间-本地支付宝支付清理,单位为秒
    const TIME_EXPIRE_LOCAL_DINGTALK_CORP_REFRESH = 600; //超时时间-本地企业钉钉更新,单位为秒
    const TIME_EXPIRE_LOCAL_DINGTALK_CORP_CLEAR = 3600; //超时时间-本地企业钉钉清理,单位为秒
    const TIME_EXPIRE_LOCAL_LIVE_EDUCATION_BJY_REFRESH = 600; //超时时间-本地教育直播百家云配置更新,单位为秒
    const TIME_EXPIRE_LOCAL_LIVE_EDUCATION_BJY_CLEAR = 3600; //超时时间-本地教育直播百家云配置清理,单位为秒
    const TIME_EXPIRE_SESSION = 259200; //超时时间-session,单位为秒
    const TIME_EXPIRE_SWOOLE_CLIENT_HTTP = 3000; //超时时间-http服务客户端,单位为毫秒
    const TIME_EXPIRE_SWOOLE_CLIENT_RPC = 3000; //超时时间-rpc服务客户端,单位为毫秒
    const TIME_EXPIRE_LOCAL_JPUSH_APP_REFRESH = 600; //超时时间-本地极光推送应用更新,单位为秒
    const TIME_EXPIRE_LOCAL_JPUSH_APP_CLEAR = 3600; //超时时间-本地极光推送应用清理,单位为秒
    const TIME_EXPIRE_LOCAL_JPUSH_GROUP_REFRESH = 600; //超时时间-本地极光推送分组更新,单位为秒
    const TIME_EXPIRE_LOCAL_JPUSH_GROUP_CLEAR = 3600; //超时时间-本地极光推送分组清理,单位为秒
    const TIME_EXPIRE_LOCAL_PAY_PAYPAL_REFRESH = 600; //超时时间-本地贝宝支付配置更新,单位为秒
    const TIME_EXPIRE_LOCAL_PAY_PAYPAL_CLEAR = 3600; //超时时间-本地贝宝支付配置清理,单位为秒
    const TIME_EXPIRE_LOCAL_PAY_UNION_CHANNELS_REFRESH = 600; //超时时间-本地银联支付全渠道配置更新,单位为秒
    const TIME_EXPIRE_LOCAL_PAY_UNION_CHANNELS_CLEAR = 3600; //超时时间-本地银联支付全渠道配置清理,单位为秒
    const TIME_EXPIRE_LOCAL_PAY_UNION_QUICK_PASS_REFRESH = 600; //超时时间-本地银联支付云闪付配置更新,单位为秒
    const TIME_EXPIRE_LOCAL_PAY_UNION_QUICK_PASS_CLEAR = 3600; //超时时间-本地银联支付云闪付配置清理,单位为秒

    //任务常量,4位字符串,数字和字母组成,纯数字的为框架内部任务,其他为自定义任务
    const TASK_TYPE_CLEAR_API_SIGN_CACHE = '0001'; //任务类型-清理api签名缓存
    const TASK_TYPE_CLEAR_LOCAL_USER_CACHE = '0002'; //任务类型-清除本地用户信息缓存
    const TASK_TYPE_CLEAR_LOCAL_WX_CACHE = '0003'; //任务类型-清除本地微信缓存
    const TASK_TYPE_TIME_WHEEL_TASK = '0004'; //任务类型-时间轮任务
    const TASK_TYPE_REFRESH_TOKEN_EXPIRE = '0005'; //任务类型-刷新令牌到期时间
    const TASK_TYPE_CODE_WEBHOOK = '1000'; //任务类型-代码WebHook

    //消息队列常量
    const MESSAGE_QUEUE_TYPE_REDIS = 'redis'; //类型-redis
    const MESSAGE_QUEUE_TYPE_KAFKA = 'kafka'; //类型-kafka
    const MESSAGE_QUEUE_TYPE_RABBIT = 'rabbit'; //类型-rabbit
    const MESSAGE_QUEUE_TOPIC_MSG_HANDLER = 'msghandler'; //主题-消息处理
    //标识 后三位纯数字的为框架内部自用,其他的为业务使用
    const MESSAGE_QUEUE_TAG_RABBIT_COMMON = SY_ENV . SY_PROJECT . '000'; //rabbit-通用
    const MESSAGE_QUEUE_TAG_RABBIT_MESSAGE_HANDLER = SY_ENV . SY_PROJECT . '001'; //rabbit-消息处理

    //服务预处理常量,标识长度为5位,第一位固定为/,后四位代表不同预处理操作,其中后四位全为数字的为框架内部预留标识
    const PRE_PROCESS_TAG_HTTP_FRAME_SERVER_INFO = '/0000'; //HTTP服务框架内部标识-服务信息
    const PRE_PROCESS_TAG_HTTP_FRAME_PHP_INFO = '/0001'; //HTTP服务框架内部标识-php环境信息
    const PRE_PROCESS_TAG_HTTP_FRAME_HEALTH_CHECK = '/0002'; //HTTP服务框架内部标识-健康检测
    const PRE_PROCESS_TAG_RPC_FRAME_SERVER_INFO = '/0000'; //RPC服务框架内部标识-服务信息

    //容量常量
    const SIZE_SERVER_PACKAGE_MAX = 6291456; //服务端容量-最大接收数据大小,单位为字节,默认为6M
    const SIZE_CLIENT_SOCKET_BUFFER = 12582912; //客户端容量-连接的缓存区大小,单位为字节,默认为12M
    const SIZE_CLIENT_BUFFER_OUTPUT = 4194304; //客户端容量-单次最大发送数据大小,单位为字节,默认为4M

    //进程池服务标识常量,4位字符串,数字和字母组成,纯数字的为框架内部服务,其他为自定义服务
    const POOL_PROCESS_SERVICE_TAG_ENV_INFO = '0000'; //服务标识-获取环境信息

    //语言常量
    const LANG_TYPE_DEFAULT = 'zh'; //类型-默认类型
    const LANG_TYPE_ZH = 'zh'; //类型-中文
    const LANG_TYPE_EN = 'en'; //类型-英文

    //消息处理常量,小于1000000的为框架内部用
    const MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS = 10000; //类型-微信公众号-openid群发消息
    const MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS_PREVIEW = 10001; //类型-微信公众号-群发预览消息
    const MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS_ALL = 10002; //类型-微信公众号-分组群发消息
    const MESSAGE_HANDLER_TYPE_WX_ACCOUNT_TEMPLATE = 10003; //类型-微信公众号-模板消息
    const MESSAGE_HANDLER_TYPE_WX_ACCOUNT_TEMPLATE_SUBSCRIBE = 10004; //类型-微信公众号-订阅模板消息
    const MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MESSAGE_CUSTOM = 10005; //类型-微信公众号-客服消息
    const MESSAGE_HANDLER_TYPE_WX_CORP_CHAT = 11000; //类型-微信企业号-群聊会话消息
    const MESSAGE_HANDLER_TYPE_WX_CORP_MESSAGE = 11001; //类型-微信企业号-企业消息
    const MESSAGE_HANDLER_TYPE_WX_CORP_MESSAGE_LINKED = 11002; //类型-微信企业号-互联企业消息
    const MESSAGE_HANDLER_TYPE_WX_MINI_MESSAGE_CUSTOM = 12000; //类型-微信小程序-客服消息
    const MESSAGE_HANDLER_TYPE_WX_MINI_TEMPLATE = 12001; //类型-微信小程序-模板消息
    const MESSAGE_HANDLER_TYPE_DINGDING_CHAT = 20000; //类型-钉钉-群消息
    const MESSAGE_HANDLER_TYPE_DINGDING_CONVERSATION = 20001; //类型-钉钉-普通消息
    const MESSAGE_HANDLER_TYPE_DINGDING_CONVERSATION_ASYNC = 20002; //类型-钉钉-工作通知消息
    const MESSAGE_HANDLER_TYPE_VOICE_ALIYUN_TTS = 21000; //类型-阿里云语音-验证码消息
    const MESSAGE_HANDLER_TYPE_VOICE_ALIYUN_FILE = 21001; //类型-阿里云语音-语音文件消息
    const MESSAGE_HANDLER_TYPE_VOICE_QCLOUD_CODE = 22000; //类型-腾讯云语音-验证码消息
    const MESSAGE_HANDLER_TYPE_VOICE_QCLOUD_TEMPLATE = 22001; //类型-腾讯云语音-模板消息
    const MESSAGE_HANDLER_TYPE_SMS_ALIYUN_SINGLE = 23000; //类型-阿里云短信-单发消息
    const MESSAGE_HANDLER_TYPE_SMS_ALIYUN_BATCH = 23001; //类型-阿里云短信-群发消息
    const MESSAGE_HANDLER_TYPE_SMS_DAYU = 23005; //类型-大鱼短信消息
    const MESSAGE_HANDLER_TYPE_SMS_YUN253 = 23010; //类型-253云短信消息
    const MESSAGE_HANDLER_TYPE_MAIL_PHP = 24000; //类型-php邮件消息
    const MESSAGE_HANDLER_TYPE_MAIL_SWIFT = 24001; //类型-swift邮件消息

    public static $totalLangType = [
        self::LANG_TYPE_ZH => '中文',
        self::LANG_TYPE_EN => '英文',
    ];
}
