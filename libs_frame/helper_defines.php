<?php
/**
 * 项目初始化基础配置
 * User: 姜伟
 * Date: 2019/1/16 0016
 * Time: 9:00
 */
ini_set('display_errors', 'On');
error_reporting(E_ALL);
date_default_timezone_set('PRC');
define('SY_VERSION', '6.8.4');
$syLogPath = ini_get('seaslog.default_basepath');
if (substr($syLogPath, -1) == '/') {
    define('SY_LOG_PATH', $syLogPath . 'sy' . SY_PROJECT);
} else {
    define('SY_LOG_PATH', $syLogPath . '/sy' . SY_PROJECT);
}
unset($syLogPath);

//是否连接数据库
if (!defined('SY_DATABASE')) {
    define('SY_DATABASE', true);
}
//是否连接memcache
if (!defined('SY_MEMCACHE')) {
    define('SY_MEMCACHE', false);
}
//是否本地缓存微信账号数据
if (!defined('SY_LC_WX_ACCOUNT')) {
    define('SY_LC_WX_ACCOUNT', false);
}
//是否本地缓存微信开放平台账号数据
if (!defined('SY_LC_WXOPEN_AUTHORIZER')) {
    define('SY_LC_WXOPEN_AUTHORIZER', false);
}
//请求异常处理类型 true:框架处理 false:项目处理
if (!defined('SY_REQ_EXCEPTION_HANDLE_TYPE')) {
    define('SY_REQ_EXCEPTION_HANDLE_TYPE', true);
}
//jwt会话有效时间,单位为秒
if (!defined('SY_SESSION_JW_EXPIRE')) {
    define('SY_SESSION_JW_EXPIRE', 86400);
}
if (!is_int(SY_SESSION_JW_EXPIRE)) {
    exit('jwt会话有效时间必须为整数' . PHP_EOL);
} elseif (SY_SESSION_JW_EXPIRE < 3600) {
    exit('jwt会话有效时间必须不小于3600秒' . PHP_EOL);
}
//jwt会话刷新标识有效时间,单位为秒
define('SY_SESSION_JW_RID_EXPIRE', (SY_SESSION_JW_EXPIRE + 180));

//淘宝环境链接
if (!defined('SY_TAOBAO_ENV')) {
    define('SY_TAOBAO_ENV', 'https://eco.taobao.com/router/rest');
}

$aliOpenConfigs = \Tool\Tool::getConfig('project.' . SY_ENV . SY_PROJECT);
$proxyStatus = (int)\Tool\Tool::getArrayVal($aliOpenConfigs, 'aliopen.proxy.status', 0, true);
if ($proxyStatus > 0) {
    define('ALIOPEN_ENABLE_HTTP_PROXY', true);
} else {
    define('ALIOPEN_ENABLE_HTTP_PROXY', false);
}
$proxyIp = (string)\Tool\Tool::getArrayVal($aliOpenConfigs, 'aliopen.proxy.ip', '127.0.0.1', true);
if (preg_match('/^(\.(\d|[1-9]\d|1\d{2}|2[0-4]\d|25[0-5])){4}$/', '.' . $proxyIp) > 0) {
    define('ALIOPEN_HTTP_PROXY_IP', $proxyIp);
} else {
    throw new \SyException\Common\CheckException('代理IP不合法', \SyConstant\ErrorCode::COMMON_SERVER_ERROR);
}
$proxyPort = (int)\Tool\Tool::getArrayVal($aliOpenConfigs, 'aliopen.proxy.port', 8888, true);
if (($proxyPort > 1000) && ($proxyPort <= 65535)) {
    define('ALIOPEN_HTTP_PROXY_PORT', $proxyPort);
} else {
    throw new \SyException\Common\CheckException('代理端口不合法', \SyConstant\ErrorCode::COMMON_SERVER_ERROR);
}
unset($aliOpenConfigs);

//Http响应的错误状态码
if (!defined('SY_HTTP_RSP_CODE_ERROR')) {
    define('SY_HTTP_RSP_CODE_ERROR', 200);
}
