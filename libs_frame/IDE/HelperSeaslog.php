<?php
namespace {
    define('SEASLOG_VERSION', '2.1.0');
    define('SEASLOG_AUTHOR', 'Chitao.Gao  [ neeke@php.net ]');
    define('SEASLOG_ALL', 'ALL');
    define('SEASLOG_DEBUG', 'DEBUG');
    define('SEASLOG_INFO', 'INFO');
    define('SEASLOG_NOTICE', 'NOTICE');
    define('SEASLOG_WARNING', 'WARNING');
    define('SEASLOG_ERROR', 'ERROR');
    define('SEASLOG_CRITICAL', 'CRITICAL');
    define('SEASLOG_ALERT', 'ALERT');
    define('SEASLOG_EMERGENCY', 'EMERGENCY');
    define('SEASLOG_DETAIL_ORDER_ASC', 1);
    define('SEASLOG_DETAIL_ORDER_DESC', 2);
    define('SEASLOG_APPENDER_FILE', 1);
    define('SEASLOG_APPENDER_TCP', 2);
    define('SEASLOG_APPENDER_UDP', 3);
    define('SEASLOG_CLOSE_LOGGER_STREAM_MOD_ALL', 1);
    define('SEASLOG_CLOSE_LOGGER_STREAM_MOD_ASSIGN', 2);
    define('SEASLOG_REQUEST_VARIABLE_DOMAIN_PORT', 1);
    define('SEASLOG_REQUEST_VARIABLE_REQUEST_URI', 2);
    define('SEASLOG_REQUEST_VARIABLE_REQUEST_METHOD', 3);
    define('SEASLOG_REQUEST_VARIABLE_CLIENT_IP', 4);
}

namespace  {
    final class SeasLog {
        public function __construct(){}

        public function __destruct(){}

        public static function setBasePath($base_path){}

        public static function getBasePath(){}

        public static function setLogger($logger){}

        public static function closeLoggerStream($model, $logger = null){}

        public static function getLastLogger(){}

        public static function setRequestID($request_id){}

        public static function getRequestID(){}

        public static function setDatetimeFormat($format){}

        public static function getDatetimeFormat(){}

        public static function setRequestVariable($key, $value = null){}

        public static function getRequestVariable($key){}

        public static function analyzerCount($level, $log_path = null, $key_word = null){}

        public static function analyzerDetail($level, $log_path = null, $key_word = null, $start = null, $limit = null, $order = null){}

        public static function getBuffer(){}

        public static function getBufferCount(){}

        public static function getBufferEnabled(){}

        public static function flushBuffer($type = null){}

        public static function log($level, $message = null, $context = null, $logger = null){}

        public static function debug($message, $context = null, $logger = null){}

        public static function info($message, $context = null, $logger = null){}

        public static function notice($message, $context = null, $logger = null){}

        public static function warning($message, $context = null, $logger = null){}

        public static function error($message, $context = null, $logger = null){}

        public static function critical($message, $context = null, $logger = null){}

        public static function alert($message, $context = null, $logger = null){}

        public static function emergency($message, $context = null, $logger = null){}
    }
}

namespace {
    function seaslog_get_version(){}

    function seaslog_get_author(){}
}
