<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/1 0001
 * Time: 15:30
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
    const DATA_KEY_XHPROF_SERVER = 'SyXhProf'; //键名-SERVER中函数调用链图生成字段
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
    const REDIS_PREFIX_VMS_XUNFEI = 'sy' . SY_PROJECT . '20700_'; //前缀-科大讯飞语音缓存
    const REDIS_PREFIX_REQUEST_RATE = 'sy' . SY_PROJECT . '20800_'; //前缀-请求频率缓存

    //YAC常量,以0000开头的前缀为框架内部前缀,并键名总长度不超过48个字符串
    const YAC_PREFIX_FUSE = '0000'; //前缀-熔断器
    const YAC_PREFIX_API_SIGN = '0001'; //前缀-接口签名

    //校验器常量
    const VALIDATOR_DATA_TYPE_STRING = 'string'; //数据类型-字符串
    const VALIDATOR_DATA_TYPE_INT = 'int'; //数据类型-整数
    const VALIDATOR_DATA_TYPE_DOUBLE = 'double'; //数据类型-浮点数
    const VALIDATOR_TAG_REQUIRED = 'required'; //标识-必填
    const VALIDATOR_TAG_MIN = 'min'; //标识-最小
    const VALIDATOR_TAG_MAX = 'max'; //标识-最大
    const VALIDATOR_TAG_REGEX = 'regex'; //标识-正则表达式
    const VALIDATOR_TAG_PHONE = 'phone'; //标识-手机号码
    const VALIDATOR_TAG_TEL = 'tel'; //标识-联系方式
    const VALIDATOR_TAG_EMAIL = 'email'; //标识-邮箱
    const VALIDATOR_TAG_URL = 'url'; //标识-URL链接
    const VALIDATOR_TAG_JSON = 'json'; //标识-JSON
    const VALIDATOR_TAG_SIGN = 'sign'; //标识-请求签名
    const VALIDATOR_TAG_BASE_IMAGE = 'baseimage'; //标识-base64编码图片
    const VALIDATOR_TAG_IP = 'ip'; //标识-IP
    const VALIDATOR_TAG_LNG = 'lng'; //标识-经度
    const VALIDATOR_TAG_LAT = 'lat'; //标识-纬度
    const VALIDATOR_TAG_NO_JS = 'nojs'; //标识-不允许js脚本
    const VALIDATOR_TAG_NO_EMOJI = 'noemoji'; //标识-不允许emoji表情
    const VALIDATOR_TAG_ZH = 'zh'; //标识-中文,数字,字母
    const VALIDATOR_TAG_ALNUM = 'alnum'; //标识-数字,字母
    const VALIDATOR_TAG_ALPHA = 'alpha'; //标识-字母
    const VALIDATOR_TAG_DIGIT = 'digit'; //标识-数字
    const VALIDATOR_TAG_LOWER = 'lower'; //标识-小写字母
    const VALIDATOR_TAG_UPPER = 'upper'; //标识-大写字母
    const VALIDATOR_TAG_DIGIT_LOWER = 'digitlower'; //标识-数字,小写字母
    const VALIDATOR_TAG_DIGIT_UPPER = 'digitupper'; //标识-数字,大写字母
    const VALIDATOR_TAG_FRAME_TOKEN = 'frametoken'; //标识-框架令牌
    const VALIDATOR_TAG_JWT = 'jwt'; //标识-会话JWT
    const VALIDATOR_TAG_REQUEST_RATE = 'requestrate'; //标识-请求频率
    const VALIDATOR_TAG_IN = 'in'; //标识-取值枚举
    const VALIDATOR_TAG_BETWEEN = 'between'; //标识-取值区间
    const VALIDATOR_TYPE_STRING_REQUIRED = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_REQUIRED;
    const VALIDATOR_TYPE_STRING_MIN = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_MIN; //最小长度
    const VALIDATOR_TYPE_STRING_MAX = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_MAX; //最大长度
    const VALIDATOR_TYPE_STRING_REGEX = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_REGEX;
    const VALIDATOR_TYPE_STRING_PHONE = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_PHONE;
    const VALIDATOR_TYPE_STRING_TEL = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_TEL;
    const VALIDATOR_TYPE_STRING_EMAIL = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_EMAIL;
    const VALIDATOR_TYPE_STRING_URL = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_URL;
    const VALIDATOR_TYPE_STRING_JSON = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_JSON;
    const VALIDATOR_TYPE_STRING_SIGN = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_SIGN;
    const VALIDATOR_TYPE_STRING_BASE_IMAGE = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_BASE_IMAGE;
    const VALIDATOR_TYPE_STRING_IP = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_IP;
    const VALIDATOR_TYPE_STRING_LNG = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_LNG;
    const VALIDATOR_TYPE_STRING_LAT = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_LAT;
    const VALIDATOR_TYPE_STRING_NO_JS = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_NO_JS;
    const VALIDATOR_TYPE_STRING_NO_EMOJI = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_NO_EMOJI;
    const VALIDATOR_TYPE_STRING_ZH = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_ZH;
    const VALIDATOR_TYPE_STRING_ALNUM = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_ALNUM;
    const VALIDATOR_TYPE_STRING_ALPHA = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_ALPHA;
    const VALIDATOR_TYPE_STRING_DIGIT = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_DIGIT;
    const VALIDATOR_TYPE_STRING_LOWER = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_LOWER;
    const VALIDATOR_TYPE_STRING_UPPER = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_UPPER;
    const VALIDATOR_TYPE_STRING_DIGIT_LOWER = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_DIGIT_LOWER;
    const VALIDATOR_TYPE_STRING_DIGIT_UPPER = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_DIGIT_UPPER;
    const VALIDATOR_TYPE_STRING_FRAME_TOKEN = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_FRAME_TOKEN;
    const VALIDATOR_TYPE_STRING_JWT = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_JWT;
    const VALIDATOR_TYPE_STRING_REQUEST_RATE = self::VALIDATOR_DATA_TYPE_STRING . self::VALIDATOR_TAG_REQUEST_RATE;
    const VALIDATOR_TYPE_INT_REQUIRED = self::VALIDATOR_DATA_TYPE_INT . self::VALIDATOR_TAG_REQUIRED;
    const VALIDATOR_TYPE_INT_MIN = self::VALIDATOR_DATA_TYPE_INT . self::VALIDATOR_TAG_MIN; //最小值
    const VALIDATOR_TYPE_INT_MAX = self::VALIDATOR_DATA_TYPE_INT . self::VALIDATOR_TAG_MAX; //最大值
    const VALIDATOR_TYPE_INT_IN = self::VALIDATOR_DATA_TYPE_INT . self::VALIDATOR_TAG_IN;
    const VALIDATOR_TYPE_INT_BETWEEN = self::VALIDATOR_DATA_TYPE_INT . self::VALIDATOR_TAG_BETWEEN;
    const VALIDATOR_TYPE_DOUBLE_REQUIRED = self::VALIDATOR_DATA_TYPE_DOUBLE . self::VALIDATOR_TAG_REQUIRED;
    const VALIDATOR_TYPE_DOUBLE_MIN = self::VALIDATOR_DATA_TYPE_DOUBLE . self::VALIDATOR_TAG_MIN; //最小值
    const VALIDATOR_TYPE_DOUBLE_MAX = self::VALIDATOR_DATA_TYPE_DOUBLE . self::VALIDATOR_TAG_MAX; //最大值
    const VALIDATOR_TYPE_DOUBLE_BETWEEN = self::VALIDATOR_DATA_TYPE_DOUBLE . self::VALIDATOR_TAG_BETWEEN;

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
    const TIME_EXPIRE_LOCAL_LIVE_BAIJIA_REFRESH = 600; //超时时间-本地百家云直播配置更新,单位为秒
    const TIME_EXPIRE_LOCAL_LIVE_BAIJIA_CLEAR = 3600; //超时时间-本地百家云直播配置清理,单位为秒
    const TIME_EXPIRE_SESSION = 259200; //超时时间-session,单位为秒
    const TIME_EXPIRE_SWOOLE_CLIENT_HTTP = 3000; //超时时间-http服务客户端,单位为毫秒
    const TIME_EXPIRE_SWOOLE_CLIENT_RPC = 3000; //超时时间-rpc服务客户端,单位为毫秒
    const TIME_EXPIRE_LOCAL_JPUSH_APP_REFRESH = 600; //超时时间-本地极光推送应用更新,单位为秒
    const TIME_EXPIRE_LOCAL_JPUSH_APP_CLEAR = 3600; //超时时间-本地极光推送应用清理,单位为秒
    const TIME_EXPIRE_LOCAL_JPUSH_GROUP_REFRESH = 600; //超时时间-本地极光推送分组更新,单位为秒
    const TIME_EXPIRE_LOCAL_JPUSH_GROUP_CLEAR = 3600; //超时时间-本地极光推送分组清理,单位为秒
    const TIME_EXPIRE_LOCAL_PAY_PAYPAL_CONFIG_REFRESH = 600; //超时时间-本地贝宝支付配置更新,单位为秒
    const TIME_EXPIRE_LOCAL_PAY_PAYPAL_CONFIG_CLEAR = 3600; //超时时间-本地贝宝支付配置清理,单位为秒
    const TIME_EXPIRE_LOCAL_PAY_PAYPAL_CLIENT_REFRESH = 600; //超时时间-本地贝宝支付客户端更新,单位为秒
    const TIME_EXPIRE_LOCAL_PAY_PAYPAL_CLIENT_CLEAR = 3600; //超时时间-本地贝宝支付客户端清理,单位为秒
    const TIME_EXPIRE_LOCAL_PAY_UNION_CHANNELS_REFRESH = 600; //超时时间-本地银联支付全渠道配置更新,单位为秒
    const TIME_EXPIRE_LOCAL_PAY_UNION_CHANNELS_CLEAR = 3600; //超时时间-本地银联支付全渠道配置清理,单位为秒
    const TIME_EXPIRE_LOCAL_PAY_UNION_QUICK_PASS_REFRESH = 600; //超时时间-本地银联支付云闪付配置更新,单位为秒
    const TIME_EXPIRE_LOCAL_PAY_UNION_QUICK_PASS_CLEAR = 3600; //超时时间-本地银联支付云闪付配置清理,单位为秒
    const TIME_EXPIRE_LOCAL_OBJECT_STORAGE_KODO_REFRESH = 600; //超时时间-本地对象存储七牛云配置更新,单位为秒
    const TIME_EXPIRE_LOCAL_OBJECT_STORAGE_KODO_CLEAR = 3600; //超时时间-本地对象存储七牛云配置清理,单位为秒
    const TIME_EXPIRE_LOCAL_OBJECT_STORAGE_COS_REFRESH = 600; //超时时间-本地对象存储腾讯云配置更新,单位为秒
    const TIME_EXPIRE_LOCAL_OBJECT_STORAGE_COS_CLEAR = 3600; //超时时间-本地对象存储腾讯云配置清理,单位为秒
    const TIME_EXPIRE_LOCAL_OBJECT_STORAGE_OSS_REFRESH = 600; //超时时间-本地对象存储阿里云配置更新,单位为秒
    const TIME_EXPIRE_LOCAL_OBJECT_STORAGE_OSS_CLEAR = 3600; //超时时间-本地对象存储阿里云配置清理,单位为秒

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

    //正则表达式常量
    const REGEX_IP = '/^(\.(\d|[1-9]\d|1\d{2}|2[0-4]\d|25[0-5])){4}$/'; //ip地址
    const REGEX_EMAIL = '/^\w+([-+.]\w+)*\@\w+([-.]\w+)*\.\w+([-.]\w+)*$/'; //邮箱
    const REGEX_TEL = '/^((\d{3,4}\-?)?\d{7,8}|1\d{10}|\d{5})$/'; //联系方式
    const REGEX_URL = '/^(http|https|ftp)\:\/\/\S+$/'; //链接地址
    const REGEX_URL_HTTP = '/^(http|https)\:\/\/\S+$/'; //链接地址-http
    const REGEX_ALIPAY_SHOP_CONTACT = '/^[0-9\+\-]{5,15}$/'; //支付宝-门店电话号码
    const REGEX_LOCATION_LNG = '/^[-]?(\d(\.\d+)?|[1-9]\d(\.\d+)?|1[0-7]\d(\.\d+)?|180)$/'; //地区-经度
    const REGEX_LOCATION_LAT = '/^[\-]?(\d(\.\d+)?|[1-8]\d(\.\d+)?|90)$/'; //地区-纬度
    const REGEX_PROMOTION_TBK_PID = '/^mm(_\d{1,12}){3}$/'; //淘宝客-pid
    const REGEX_URI_YAF = '/^\/[0-9a-zA-Z\/]*$/'; //URI-yaf
    const REGEX_WX_ORIGIN_ID = '/^[0-9a-z_]{15}$/'; //微信-原始ID
    const REGEX_WX_OPEN_ID = '/^[0-9a-zA-Z\-\_]{28}$/'; //微信-openid

    public static $totalLangType = [
        self::LANG_TYPE_ZH => '中文',
        self::LANG_TYPE_EN => '英文',
    ];

    public static $totalValidatorDataTypes = [
        self::VALIDATOR_DATA_TYPE_STRING => '字符串',
        self::VALIDATOR_DATA_TYPE_INT => '整数',
        self::VALIDATOR_DATA_TYPE_DOUBLE => '浮点数',
    ];
}
