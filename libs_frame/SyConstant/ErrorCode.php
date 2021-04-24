<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/2 0002
 * Time: 11:22
 */

namespace SyConstant;

use SyTrait\SimpleTrait;

class ErrorCode
{
    use SimpleTrait;

    //公共错误,取值范围:10000-99999
    const COMMON_SUCCESS = 0;
    const COMMON_MIN_NUM = 10000;
    const COMMON_PARAM_ERROR = 10000;
    const COMMON_SERVER_ERROR = 10500;
    const COMMON_SERVER_EXCEPTION = 10501;
    const COMMON_SERVER_FATAL = 10502;
    const COMMON_SERVER_RESOURCE_NOT_EXIST = 10503;
    const COMMON_SERVER_BUSY = 10504;
    const COMMON_SERVER_TOKEN_EXPIRE = 10505;
    const COMMON_ROUTE_MODULE_NOT_ACCEPT = 11000;
    const COMMON_ROUTE_URI_FORMAT_ERROR = 11001;
    const COMMON_ROUTE_CONTROLLER_NOT_EXIST = 11002;
    const COMMON_ROUTE_ACTION_NOT_EXIST = 11003;

    //validator错误,取值范围:100000-100199
    const VALIDATOR_TYPE_ERROR = 100000;
    const VALIDATOR_RULE_EMPTY = 100001;
    const VALIDATOR_RULE_ERROR = 100002;

    //MYSQL错误,取值范围:100400-100599
    const MYSQL_CONNECTION_ERROR = 100400;
    const MYSQL_INSERT_ERROR = 100401;
    const MYSQL_DELETE_ERROR = 100402;
    const MYSQL_UPDATE_ERROR = 100403;
    const MYSQL_SELECT_ERROR = 100404;
    const MYSQL_UPSERT_ERROR = 100405;

    //REDIS错误,取值范围:100600-100799
    const REDIS_CONNECTION_ERROR = 100600;
    const REDIS_AUTH_ERROR = 100601;

    //SWOOLE错误,取值范围:100800-100999
    const SWOOLE_SERVER_PARAM_ERROR = 100800;
    const SWOOLE_SERVER_NOT_EXIST_ERROR = 100801;
    const SWOOLE_SERVER_NO_RESPONSE_ERROR = 100802;
    const SWOOLE_SERVER_REQUEST_FAIL = 100803;

    //反射错误,取值范围:101000-101199
    const REFLECT_RESOURCE_NOT_EXIST = 101000;
    const REFLECT_ANNOTATION_DATA_ERROR = 101001;

    //邮件错误,取值范围:101200-101399
    const MAIL_SERVER_NOT_EXIST = 101200;
    const MAIL_SEND_FAIL = 101201;
    const MAIL_PARAM_ERROR = 101202;

    //微信错误,取值范围:101400-101599
    const WX_PARAM_ERROR = 101400;
    const WX_POST_ERROR = 101401;
    const WX_GET_ERROR = 101402;

    //微信开放平台错误,取值范围:101600-101799
    const WXOPEN_PARAM_ERROR = 101600;
    const WXOPEN_POST_ERROR = 101601;
    const WXOPEN_GET_ERROR = 101602;

    //支付宝错误,取值范围:101800-101999
    const ALIPAY_PARAM_ERROR = 101800;
    const ALIPAY_POST_ERROR = 101801;
    const ALIPAY_GET_ERROR = 101802;
    const ALIPAY_AUTH_PARAM_ERROR = 101850;
    const ALIPAY_LIFE_PARAM_ERROR = 101851;
    const ALIPAY_PAY_PARAM_ERROR = 101852;
    const ALIPAY_SHOP_PARAM_ERROR = 101853;
    const ALIPAY_FUND_PARAM_ERROR = 101854;

    //短信错误,取值范围:102000-102199
    const SMS_PARAM_ERROR = 102000;
    const SMS_POST_ERROR = 102001;
    const SMS_GET_ERROR = 102002;
    const SMS_REQ_ALIYUN_ERROR = 102010;
    const SMS_REQ_DAYU_ERROR = 102011;
    const SMS_REQ_YUN253_ERROR = 102012;

    //图片错误,取值范围:102200-102399
    const IMAGE_UPLOAD_PARAM_ERROR = 102200;
    const IMAGE_UPLOAD_FAIL = 102201;

    //签名错误,取值范围:103000-103099
    const SIGN_ERROR = 103000;
    const SIGN_TIME_ERROR = 103001;
    const SIGN_NONCE_ERROR = 103002;

    //MONGO错误,取值范围:103100-103199
    const MONGO_CONNECTION_ERROR = 103100;
    const MONGO_PARAM_ERROR = 103101;
    const MONGO_CREATE_ERROR = 103102;
    const MONGO_INSERT_ERROR = 103103;
    const MONGO_DELETE_ERROR = 103104;
    const MONGO_UPDATE_ERROR = 103105;
    const MONGO_SELECT_ERROR = 103106;

    //Solr错误,取值范围:103300-103399
    const SOLR_PARAM_ERROR = 103300;
    const SOLR_POST_ERROR = 103301;
    const SOLR_GET_ERROR = 103302;
    const SOLR_ANALYSIS_ERROR = 103303;
    const SOLR_ADD_ERROR = 103304;
    const SOLR_DELETE_ERROR = 103305;
    const SOLR_UPDATE_ERROR = 103306;
    const SOLR_SELECT_ERROR = 103307;

    //地图错误,取值范围:103400-103599
    const MAP_TENCENT_PARAM_ERROR = 103400;
    const MAP_TENCENT_GET_ERROR = 103401;
    const MAP_TENCENT_POST_ERROR = 103402;
    const MAP_BAIDU_PARAM_ERROR = 103410;
    const MAP_BAIDU_GET_ERROR = 103411;
    const MAP_BAIDU_POST_ERROR = 103412;
    const MAP_GAODE_PARAM_ERROR = 103420;
    const MAP_GAODE_GET_ERROR = 103421;
    const MAP_GAODE_POST_ERROR = 103422;

    //Twig错误,取值范围:103600-103699
    const TWIG_PARAM_ERROR = 103600;

    //定时器错误,取值范围:103700-103799
    const TIMER_PARAM_ERROR = 103700;
    const TIMER_GET_ERROR = 103701;

    //Cron错误,取值范围:103800-103899
    const CRON_FORMAT_ERROR = 103800;
    const CRON_SECOND_ERROR = 103801;
    const CRON_MINUTE_ERROR = 103802;
    const CRON_HOUR_ERROR = 103803;
    const CRON_DAY_ERROR = 103804;
    const CRON_MONTH_ERROR = 103805;
    const CRON_WEEK_ERROR = 103806;

    //消息队列错误,取值范围:103900-103999
    const MESSAGE_QUEUE_TOPIC_ERROR = 103900;
    const MESSAGE_QUEUE_TOPIC_DATA_ERROR = 103901;
    const MESSAGE_QUEUE_PARAM_ERROR = 103902;
    const MESSAGE_QUEUE_KAFKA_PRODUCER_ERROR = 103903;
    const MESSAGE_QUEUE_KAFKA_CONSUMER_ERROR = 103904;

    //etcd配置错误,取值范围:104000-104099
    const ETCD_PARAM_ERROR = 104000;
    const ETCD_SEND_REQ_ERROR = 104001;
    const ETCD_GET_DATA_ERROR = 104002;

    //Smarty错误,取值范围:104100-104199
    const SMARTY_PARAM_ERROR = 104100;

    //IM错误,取值范围:104200-104299
    const IM_PARAM_ERROR = 104200;
    const IM_POST_ERROR = 104201;
    const IM_GET_ERROR = 104202;
    const IM_SIGN_ERROR = 104203;

    //ffmpeg错误,取值范围:104300-104399
    const FFMPEG_PARAM_ERROR = 104300;
    const FFMPEG_EXEC_ERROR = 104301;

    //amqp错误,取值范围:104400-104499
    const AMQP_CONNECT_ERROR = 104400;

    //消息推送错误,取值范围:104500-104599
    const MESSAGE_PUSH_PARAM_ERROR = 104500;
    const MESSAGE_PUSH_POST_ERROR = 104501;
    const MESSAGE_PUSH_GET_ERROR = 104502;
    const MESSAGE_PUSH_REQ_ALI_ERROR = 104510;
    const MESSAGE_PUSH_REQ_JPUSH_ERROR = 104511;
    const MESSAGE_PUSH_REQ_XINGE_ERROR = 104512;
    const MESSAGE_PUSH_REQ_BAIDU_ERROR = 104513;

    //打印错误,取值范围:104600-104699
    const PRINT_PARAM_ERROR = 104600;
    const PRINT_POST_ERROR = 104601;
    const PRINT_GET_ERROR = 104602;

    //微信服务商错误,取值范围:104700-104899
    const WXPROVIDER_CORP_PARAM_ERROR = 104700;
    const WXPROVIDER_CORP_POST_ERROR = 104701;
    const WXPROVIDER_CORP_GET_ERROR = 104702;

    //钉钉错误,取值范围:104900-104999
    const DING_TALK_PARAM_ERROR = 104900;
    const DING_TALK_POST_ERROR = 104901;
    const DING_TALK_GET_ERROR = 104902;

    //MEMCACHE错误,取值范围:105000-105099
    const MEMCACHE_CONNECTION_ERROR = 105000;

    //会话错误,取值范围:106000-106099
    const SESSION_JWT_REFRESH_ERROR = 106000;
    const SESSION_JWT_DATA_ERROR = 106001;
    const SESSION_JWT_SIGN_ERROR = 106002;

    //物流错误,取值范围:106100-106199
    const LOGISTICS_PARAM_ERROR = 106100;
    const LOGISTICS_POST_ERROR = 106101;
    const LOGISTICS_GET_ERROR = 106102;
    const LOGISTICS_REQ_ALIMARKET_ALI_ERROR = 106110;
    const LOGISTICS_REQ_KD100_ERROR = 106111;
    const LOGISTICS_REQ_KDNIAO_ERROR = 106112;
    const LOGISTICS_REQ_TAOBAO_ERROR = 106113;

    //物联网错误,取值范围:106200-106399
    const IOT_PARAM_ERROR = 106200;
    const IOT_POST_ERROR = 106201;
    const IOT_GET_ERROR = 106202;
    const IOT_REQ_ALIYUN_ERROR = 106210;
    const IOT_REQ_BAIDU_ERROR = 106211;
    const IOT_REQ_TENCENT_ERROR = 106212;

    //货币错误,取值范围:107000-107099
    const CURRENCY_PARAM_ERROR = 107000;
    const CURRENCY_POST_ERROR = 107001;
    const CURRENCY_GET_ERROR = 107002;
    const CURRENCY_REQ_ALIMARKET_YIYUAN_ERROR = 107010;
    const CURRENCY_REQ_ALIMARKET_JISU_ERROR = 107011;

    //积分错误,取值范围:107200-107299
    const CREDIT_PARAM_ERROR = 107200;
    const CREDIT_POST_ERROR = 107201;
    const CREDIT_GET_ERROR = 107202;
    const CREDIT_REQ_MAILE_ERROR = 107210;

    //语音服务错误,取值范围:107300-107399
    const VMS_PARAM_ERROR = 107300;
    const VMS_POST_ERROR = 107301;
    const VMS_GET_ERROR = 107302;
    const VMS_REQ_ALIYUN_ERROR = 107310;
    const VMS_REQ_QCLOUD_ERROR = 107311;
    const VMS_REQ_XUNFEI_ERROR = 107312;
    const VMS_REQ_CHIVOX_ERROR = 107313;

    //消息处理错误,取值范围:107400-107499
    const MESSAGE_HANDLER_PARAM_ERROR = 107400;
    const MESSAGE_HANDLER_INVOKE_ERROR = 107401;

    //支付错误,取值范围:107500-107999
    const PAY_PARAM_ERROR = 107500;
    const PAY_REQ_ERROR = 107501;
    const PAY_PAYPAL_PARAM_ERROR = 107510;
    const PAY_PAYPAL_REQ_ERROR = 107511;
    const PAY_UNION_PARAM_ERROR = 107520;
    const PAY_UNION_REQ_ERROR = 107521;

    //云服务错误,取值范围:108000-108199
    const CLOUD_TENCENT_ERROR = 108000;
    const CLOUD_ALI_ERROR = 108001;
    const CLOUD_QINIU_ERROR = 108002;

    //直播错误,取值范围:108200-108399
    const LIVE_PARAM_ERROR = 108200;
    const LIVE_REQ_ERROR = 108201;
    const LIVE_BAIJIA_REQ_ERROR = 108210;
    const LIVE_BAIJIA_PARAM_ERROR = 108211;
    const LIVE_TENCENT_REQ_ERROR = 108220;
    const LIVE_TENCENT_PARAM_ERROR = 108221;

    //对象存储错误,取值范围:108400-108599
    const OBJECT_STORAGE_PARAM_ERROR = 108400;
    const OBJECT_STORAGE_REQ_ERROR = 108401;
    const OBJECT_STORAGE_OSS_REQ_ERROR = 108410;
    const OBJECT_STORAGE_OSS_PARAM_ERROR = 108411;
    const OBJECT_STORAGE_OSS_CONNECT_ERROR = 108412;
    const OBJECT_STORAGE_COS_REQ_ERROR = 108420;
    const OBJECT_STORAGE_COS_PARAM_ERROR = 108421;
    const OBJECT_STORAGE_COS_POST_ERROR = 108422;
    const OBJECT_STORAGE_COS_GET_ERROR = 108423;
    const OBJECT_STORAGE_COS_PUT_ERROR = 108424;
    const OBJECT_STORAGE_COS_DELETE_ERROR = 108425;
    const OBJECT_STORAGE_COS_HEAD_ERROR = 108426;
    const OBJECT_STORAGE_COS_OPTIONS_ERROR = 108427;
    const OBJECT_STORAGE_KODO_REQ_ERROR = 108430;
    const OBJECT_STORAGE_KODO_PARAM_ERROR = 108431;
    const OBJECT_STORAGE_KODO_POST_ERROR = 108432;
    const OBJECT_STORAGE_KODO_GET_ERROR = 108433;

    //推广错误,取值范围:108600-108799
    const PROMOTION_TBK_PARAM_ERROR = 108600;
    const PROMOTION_TBK_REQ_ERROR = 108601;
    const PROMOTION_JDK_PARAM_ERROR = 108610;
    const PROMOTION_JDK_REQ_ERROR = 108611;

    //MQTT错误,取值范围:108800-108999
    const MQTT_CONNECTION_ERROR = 108800;
    const MQTT_AUTH_ERROR = 108801;

    //抖音错误,取值范围:109000-109100
    const DOUYIN_PARAM_ERROR = 109000;
    const DOUYIN_REQ_ERROR = 109001;
    const DOUYIN_OAUTH_PARAM_ERROR = 109010;
    const DOUYIN_OAUTH_REQ_ERROR = 109011;
    const DOUYIN_DATA_PARAM_ERROR = 109015;
    const DOUYIN_DATA_REQ_ERROR = 109016;
    const DOUYIN_ENTERPRISE_PARAM_ERROR = 109020;
    const DOUYIN_ENTERPRISE_REQ_ERROR = 109021;
    const DOUYIN_IMAGE_PARAM_ERROR = 109025;
    const DOUYIN_IMAGE_REQ_ERROR = 109026;
    const DOUYIN_POI_PARAM_ERROR = 109030;
    const DOUYIN_POI_REQ_ERROR = 109031;
    const DOUYIN_COMMENT_PARAM_ERROR = 109035;
    const DOUYIN_COMMENT_REQ_ERROR = 109036;
    const DOUYIN_TOOL_PARAM_ERROR = 109040;
    const DOUYIN_TOOL_REQ_ERROR = 109041;
    const DOUYIN_USER_PARAM_ERROR = 109045;
    const DOUYIN_USER_REQ_ERROR = 109046;
    const DOUYIN_VIDEO_PARAM_ERROR = 109050;
    const DOUYIN_VIDEO_REQ_ERROR = 109051;

    protected static $msgArr = [
        self::COMMON_SUCCESS => '成功',
        self::COMMON_PARAM_ERROR => '参数错误',
        self::COMMON_SERVER_ERROR => '服务出错',
        self::COMMON_SERVER_EXCEPTION => '服务出错',
        self::COMMON_SERVER_FATAL => '服务出错',
        self::COMMON_SERVER_RESOURCE_NOT_EXIST => '资源不存在',
        self::COMMON_SERVER_BUSY => '服务繁忙',
        self::COMMON_SERVER_TOKEN_EXPIRE => '令牌已过期',
        self::COMMON_ROUTE_MODULE_NOT_ACCEPT => '模块不支持',
        self::COMMON_ROUTE_URI_FORMAT_ERROR => '路由格式错误',
        self::COMMON_ROUTE_CONTROLLER_NOT_EXIST => '控制器不存在',
        self::COMMON_ROUTE_ACTION_NOT_EXIST => '方法不存在',
        self::VALIDATOR_TYPE_ERROR => '校验器不支持',
        self::VALIDATOR_RULE_EMPTY => '校验规则为空',
        self::VALIDATOR_RULE_ERROR => '校验规则格式不合法',
        self::MYSQL_CONNECTION_ERROR => 'MYSQL连接出错',
        self::MYSQL_INSERT_ERROR => 'MYSQL添加数据出错',
        self::MYSQL_UPDATE_ERROR => 'MYSQL修改数据出错',
        self::MYSQL_DELETE_ERROR => 'MYSQL删除数据出错',
        self::MYSQL_SELECT_ERROR => 'MYSQL查询数据出错',
        self::MYSQL_UPSERT_ERROR => 'MYSQL修改或添加数据出错',
        self::REDIS_CONNECTION_ERROR => 'REDIS连接出错',
        self::REDIS_AUTH_ERROR => 'REDIS鉴权失败',
        self::SWOOLE_SERVER_PARAM_ERROR => 'SWOOLE服务参数错误',
        self::SWOOLE_SERVER_NOT_EXIST_ERROR => 'SWOOLE服务不存在',
        self::SWOOLE_SERVER_NO_RESPONSE_ERROR => 'SWOOLE服务未设置响应数据',
        self::SWOOLE_SERVER_REQUEST_FAIL => 'SWOOLE请求失败',
        self::REFLECT_RESOURCE_NOT_EXIST => '反射资源不存在',
        self::REFLECT_ANNOTATION_DATA_ERROR => '注解数据不正确',
        self::MAIL_SERVER_NOT_EXIST => '邮件服务器不存在',
        self::MAIL_SEND_FAIL => '发送邮件失败',
        self::MAIL_PARAM_ERROR => '邮件参数错误',
        self::WX_PARAM_ERROR => '微信参数错误',
        self::WX_POST_ERROR => '微信发送POST请求出错',
        self::WX_GET_ERROR => '微信发送GET请求出错',
        self::WXOPEN_PARAM_ERROR => '微信开放平台参数错误',
        self::WXOPEN_POST_ERROR => '微信开放平台发送POST请求出错',
        self::WXOPEN_GET_ERROR => '微信开放平台发送GET请求出错',
        self::ALIPAY_PARAM_ERROR => '支付宝参数错误',
        self::ALIPAY_POST_ERROR => '支付宝发送POST请求出错',
        self::ALIPAY_GET_ERROR => '支付宝发送GET请求出错',
        self::ALIPAY_AUTH_PARAM_ERROR => '支付宝授权参数错误',
        self::ALIPAY_LIFE_PARAM_ERROR => '支付宝生活号参数错误',
        self::ALIPAY_PAY_PARAM_ERROR => '支付宝支付参数错误',
        self::ALIPAY_SHOP_PARAM_ERROR => '支付宝店铺参数错误',
        self::ALIPAY_FUND_PARAM_ERROR => '支付宝资金参数错误',
        self::SMS_PARAM_ERROR => '短信参数错误',
        self::SMS_POST_ERROR => '短信发送POST请求出错',
        self::SMS_GET_ERROR => '短信发送GET请求出错',
        self::SMS_REQ_ALIYUN_ERROR => '短信阿里云发送请求出错',
        self::SMS_REQ_DAYU_ERROR => '短信阿里大鱼发送请求出错',
        self::SMS_REQ_YUN253_ERROR => '短信253云发送请求出错',
        self::IMAGE_UPLOAD_PARAM_ERROR => '图片上传参数错误',
        self::IMAGE_UPLOAD_FAIL => '图片上传失败',
        self::SIGN_ERROR => '签名值错误',
        self::SIGN_TIME_ERROR => '签名时间错误',
        self::SIGN_NONCE_ERROR => '签名随机字符串错误',
        self::MONGO_CONNECTION_ERROR => 'Mongo连接异常',
        self::MONGO_PARAM_ERROR => 'Mongo参数错误',
        self::MONGO_CREATE_ERROR => 'Mongo创建数据库出错',
        self::MONGO_INSERT_ERROR => 'Mongo添加数据出错',
        self::MONGO_DELETE_ERROR => 'Mongo删除数据出错',
        self::MONGO_UPDATE_ERROR => 'Mongo修改数据出错',
        self::MONGO_SELECT_ERROR => 'Mongo查询数据出错',
        self::SOLR_PARAM_ERROR => 'Solr参数错误',
        self::SOLR_POST_ERROR => 'Solr发送POST请求出错',
        self::SOLR_GET_ERROR => 'Solr发送GET请求出错',
        self::SOLR_ANALYSIS_ERROR => 'Solr分词错误',
        self::SOLR_ADD_ERROR => 'Solr新增出错',
        self::SOLR_DELETE_ERROR => 'Solr删除出错',
        self::SOLR_UPDATE_ERROR => 'Solr修改出错',
        self::SOLR_SELECT_ERROR => 'Solr查询出错',
        self::MAP_TENCENT_PARAM_ERROR => '百度地图参数错误',
        self::MAP_TENCENT_GET_ERROR => '百度地图发送GET请求出错',
        self::MAP_TENCENT_POST_ERROR => '百度地图发送POST请求出错',
        self::MAP_BAIDU_PARAM_ERROR => '腾讯地图参数错误',
        self::MAP_BAIDU_GET_ERROR => '腾讯地图发送GET请求出错',
        self::MAP_BAIDU_POST_ERROR => '腾讯地图发送POST请求出错',
        self::MAP_GAODE_PARAM_ERROR => '高德地图参数错误',
        self::MAP_GAODE_GET_ERROR => '高德地图发送GET请求出错',
        self::MAP_GAODE_POST_ERROR => '高德地图发送POST请求出错',
        self::TWIG_PARAM_ERROR => 'Twig参数错误',
        self::TIMER_PARAM_ERROR => '定时器参数错误',
        self::TIMER_GET_ERROR => '定时器发送GET请求出错',
        self::CRON_FORMAT_ERROR => 'cron格式错误',
        self::CRON_SECOND_ERROR => 'cron秒钟格式错误',
        self::CRON_MINUTE_ERROR => 'cron分钟格式错误',
        self::CRON_HOUR_ERROR => 'cron小时格式错误',
        self::CRON_DAY_ERROR => 'cron日期格式错误',
        self::CRON_MONTH_ERROR => 'cron月份格式错误',
        self::CRON_WEEK_ERROR => 'cron星期格式错误',
        self::MESSAGE_QUEUE_TOPIC_ERROR => '消息队列主题错误',
        self::MESSAGE_QUEUE_TOPIC_DATA_ERROR => '消息队列主题数据错误',
        self::MESSAGE_QUEUE_PARAM_ERROR => '消息队列参数错误',
        self::MESSAGE_QUEUE_KAFKA_PRODUCER_ERROR => '消息队列KAFKA生产者出错',
        self::MESSAGE_QUEUE_KAFKA_CONSUMER_ERROR => '消息队列KAFKA消费者出错',
        self::ETCD_PARAM_ERROR => 'ETCD参数错误',
        self::ETCD_SEND_REQ_ERROR => 'ETCD发送请求出错',
        self::ETCD_GET_DATA_ERROR => 'ETCD获取数据出错',
        self::SMARTY_PARAM_ERROR => 'Smarty参数错误',
        self::IM_PARAM_ERROR => '即时通讯参数错误',
        self::IM_POST_ERROR => '即时通讯POST请求错误',
        self::IM_GET_ERROR => '即时通讯GET请求错误',
        self::IM_SIGN_ERROR => '即时通讯签名错误',
        self::FFMPEG_PARAM_ERROR => 'ffmpeg参数错误',
        self::FFMPEG_EXEC_ERROR => 'ffmpeg处理错误',
        self::AMQP_CONNECT_ERROR => 'amqp连接错误',
        self::MESSAGE_PUSH_PARAM_ERROR => '消息推送参数错误',
        self::MESSAGE_PUSH_POST_ERROR => '消息推送POST请求错误',
        self::MESSAGE_PUSH_GET_ERROR => '消息推送GET请求错误',
        self::MESSAGE_PUSH_REQ_ALI_ERROR => '阿里消息推送请求错误',
        self::MESSAGE_PUSH_REQ_JPUSH_ERROR => '极光消息推送请求错误',
        self::MESSAGE_PUSH_REQ_XINGE_ERROR => '信鸽消息推送请求错误',
        self::MESSAGE_PUSH_REQ_BAIDU_ERROR => '百度消息推送请求错误',
        self::PRINT_PARAM_ERROR => '打印参数错误',
        self::PRINT_POST_ERROR => '打印POST请求错误',
        self::PRINT_GET_ERROR => '打印GET请求错误',
        self::WXPROVIDER_CORP_PARAM_ERROR => '企业微信服务商参数错误',
        self::WXPROVIDER_CORP_POST_ERROR => '企业微信服务商发送POST请求出错',
        self::WXPROVIDER_CORP_GET_ERROR => '企业微信服务商发送GET请求出错',
        self::DING_TALK_PARAM_ERROR => '钉钉参数错误',
        self::DING_TALK_POST_ERROR => '钉钉发送POST请求出错',
        self::DING_TALK_GET_ERROR => '钉钉发送GET请求出错',
        self::MEMCACHE_CONNECTION_ERROR => 'MEMCACHE连接出错',
        self::SESSION_JWT_DATA_ERROR => '会话JWT数据错误',
        self::SESSION_JWT_SIGN_ERROR => '会话JWT签名错误',
        self::SESSION_JWT_REFRESH_ERROR => '会话JWT刷新错误',
        self::LOGISTICS_PARAM_ERROR => '物流参数错误',
        self::LOGISTICS_POST_ERROR => '物流发送POST请求出错',
        self::LOGISTICS_GET_ERROR => '物流发送GET请求出错',
        self::LOGISTICS_REQ_ALIMARKET_ALI_ERROR => '阿里云市场阿里物流发送请求出错',
        self::LOGISTICS_REQ_KD100_ERROR => '物流快递100发送请求出错',
        self::LOGISTICS_REQ_KDNIAO_ERROR => '物流快递鸟发送请求出错',
        self::LOGISTICS_REQ_TAOBAO_ERROR => '物流淘宝发送请求出错',
        self::IOT_PARAM_ERROR => '物联网参数错误',
        self::IOT_POST_ERROR => '物联网发送POST请求出错',
        self::IOT_GET_ERROR => '物联网发送GET请求出错',
        self::IOT_REQ_ALIYUN_ERROR => '物联网阿里云发送请求出错',
        self::IOT_REQ_BAIDU_ERROR => '物联网百度发送请求出错',
        self::IOT_REQ_TENCENT_ERROR => '物联网腾讯发送请求出错',
        self::CURRENCY_PARAM_ERROR => '货币参数错误',
        self::CURRENCY_POST_ERROR => '货币POST请求出错',
        self::CURRENCY_GET_ERROR => '货币GET请求出错',
        self::CURRENCY_REQ_ALIMARKET_YIYUAN_ERROR => '阿里云市场易源货币发送请求出错',
        self::CURRENCY_REQ_ALIMARKET_JISU_ERROR => '阿里云市场极速货币发送请求出错',
        self::CREDIT_PARAM_ERROR => '积分参数错误',
        self::CREDIT_POST_ERROR => '积分POST请求出错',
        self::CREDIT_GET_ERROR => '积分GET请求出错',
        self::CREDIT_REQ_MAILE_ERROR => '麦乐积分发送请求出错',
        self::VMS_PARAM_ERROR => '语音服务参数错误',
        self::VMS_POST_ERROR => '语音服务发送POST请求出错',
        self::VMS_GET_ERROR => '语音服务发送GET请求出错',
        self::VMS_REQ_ALIYUN_ERROR => '语音服务阿里云发送请求出错',
        self::VMS_REQ_QCLOUD_ERROR => '语音服务腾讯云发送请求出错',
        self::VMS_REQ_XUNFEI_ERROR => '语音服务科大讯飞发送请求出错',
        self::VMS_REQ_CHIVOX_ERROR => '语音服务驰声发送请求出错',
        self::MESSAGE_HANDLER_PARAM_ERROR => '消息处理参数错误',
        self::MESSAGE_HANDLER_INVOKE_ERROR => '消息处理调用错误',
        self::PAY_PARAM_ERROR => '支付参数错误',
        self::PAY_REQ_ERROR => '支付请求出错',
        self::PAY_PAYPAL_PARAM_ERROR => '贝宝支付参数错误',
        self::PAY_PAYPAL_REQ_ERROR => '贝宝支付请求出错',
        self::PAY_UNION_PARAM_ERROR => '银联支付参数错误',
        self::PAY_UNION_REQ_ERROR => '银联支付请求出错',
        self::CLOUD_TENCENT_ERROR => '腾讯云服务出错',
        self::CLOUD_ALI_ERROR => '阿里云服务出错',
        self::CLOUD_QINIU_ERROR => '七牛云服务出错',
        self::LIVE_PARAM_ERROR => '直播参数出错',
        self::LIVE_REQ_ERROR => '直播请求出错',
        self::LIVE_BAIJIA_REQ_ERROR => '百家云直播请求出错',
        self::LIVE_BAIJIA_PARAM_ERROR => '百家云直播参数出错',
        self::LIVE_TENCENT_REQ_ERROR => '腾讯云直播请求出错',
        self::LIVE_TENCENT_PARAM_ERROR => '腾讯云直播参数出错',
        self::OBJECT_STORAGE_PARAM_ERROR => '对象存储参数出错',
        self::OBJECT_STORAGE_REQ_ERROR => '对象存储请求出错',
        self::OBJECT_STORAGE_OSS_REQ_ERROR => '阿里云对象存储请求出错',
        self::OBJECT_STORAGE_OSS_PARAM_ERROR => '阿里云对象存储参数出错',
        self::OBJECT_STORAGE_OSS_CONNECT_ERROR => '阿里云对象存储连接出错',
        self::OBJECT_STORAGE_COS_REQ_ERROR => '腾讯云对象存储请求出错',
        self::OBJECT_STORAGE_COS_PARAM_ERROR => '腾讯云对象存储参数出错',
        self::OBJECT_STORAGE_COS_POST_ERROR => '腾讯云对象存储发送POST请求出错',
        self::OBJECT_STORAGE_COS_GET_ERROR => '腾讯云对象存储发送GET请求出错',
        self::OBJECT_STORAGE_COS_PUT_ERROR => '腾讯云对象存储发送PUT请求出错',
        self::OBJECT_STORAGE_COS_DELETE_ERROR => '腾讯云对象存储发送DELETE请求出错',
        self::OBJECT_STORAGE_COS_HEAD_ERROR => '腾讯云对象存储发送HEAD请求出错',
        self::OBJECT_STORAGE_COS_OPTIONS_ERROR => '腾讯云对象存储发送OPTIONS请求出错',
        self::OBJECT_STORAGE_KODO_REQ_ERROR => '七牛云对象存储请求出错',
        self::OBJECT_STORAGE_KODO_PARAM_ERROR => '七牛云对象存储参数出错',
        self::OBJECT_STORAGE_KODO_POST_ERROR => '七牛云对象存储POST请求出错',
        self::OBJECT_STORAGE_KODO_GET_ERROR => '七牛云对象存储GET请求出错',
        self::PROMOTION_TBK_PARAM_ERROR => '淘宝客推广参数错误',
        self::PROMOTION_TBK_REQ_ERROR => '淘宝客推广请求错误',
        self::PROMOTION_JDK_PARAM_ERROR => '京东客推广参数错误',
        self::PROMOTION_JDK_REQ_ERROR => '京东客推广请求错误',
        self::MQTT_CONNECTION_ERROR => 'mqtt连接出错',
        self::MQTT_AUTH_ERROR => 'mqtt鉴权失败',
        self::DOUYIN_PARAM_ERROR => '抖音参数错误',
        self::DOUYIN_REQ_ERROR => '抖音请求错误',
        self::DOUYIN_OAUTH_PARAM_ERROR => '抖音授权参数错误',
        self::DOUYIN_OAUTH_REQ_ERROR => '抖音授权请求错误',
        self::DOUYIN_DATA_PARAM_ERROR => '抖音数据参数错误',
        self::DOUYIN_DATA_REQ_ERROR => '抖音数据请求错误',
        self::DOUYIN_ENTERPRISE_PARAM_ERROR => '抖音企业号参数错误',
        self::DOUYIN_ENTERPRISE_REQ_ERROR => '抖音企业号请求错误',
        self::DOUYIN_IMAGE_PARAM_ERROR => '抖音图片参数错误',
        self::DOUYIN_IMAGE_REQ_ERROR => '抖音图片请求错误',
        self::DOUYIN_POI_PARAM_ERROR => '抖音兴趣点参数错误',
        self::DOUYIN_POI_REQ_ERROR => '抖音兴趣点请求错误',
        self::DOUYIN_COMMENT_PARAM_ERROR => '抖音搜索参数错误',
        self::DOUYIN_COMMENT_REQ_ERROR => '抖音搜索请求错误',
        self::DOUYIN_TOOL_PARAM_ERROR => '抖音工具参数错误',
        self::DOUYIN_TOOL_REQ_ERROR => '抖音工具请求错误',
        self::DOUYIN_USER_PARAM_ERROR => '抖音用户参数错误',
        self::DOUYIN_USER_REQ_ERROR => '抖音用户请求错误',
        self::DOUYIN_VIDEO_PARAM_ERROR => '抖音视频参数错误',
        self::DOUYIN_VIDEO_REQ_ERROR => '抖音视频请求错误',
    ];

    /**
     * 获取错误信息
     *
     * @param int $errorCode 错误码
     *
     * @return mixed|string
     */
    public static function getMsg(int $errorCode)
    {
        return self::$msgArr[$errorCode] ?? '';
    }
}
