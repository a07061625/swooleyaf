<?php
namespace {
    define('SEASLOG_VERSION', '1.6.9');
    define('SEASLOG_AUTHOR', 'Chitao.Gao  [ neeke@php.net ]');
    define('SEASLOG_ALL', 'all');
    define('SEASLOG_DEBUG', 'debug');
    define('SEASLOG_INFO', 'info');
    define('SEASLOG_NOTICE', 'notice');
    define('SEASLOG_WARNING', 'warning');
    define('SEASLOG_ERROR', 'error');
    define('SEASLOG_CRITICAL', 'critical');
    define('SEASLOG_ALERT', 'alert');
    define('SEASLOG_EMERGENCY', 'emergency');
    define('SEASLOG_DETAIL_ORDER_ASC', 1);
    define('SEASLOG_DETAIL_ORDER_DESC', 2);
    define('SEASLOG_APPENDER_FILE', 1);
    define('SEASLOG_APPENDER_TCP', 2);
    define('SEASLOG_APPENDER_UDP', 3);
}

namespace  {
    class SeasLog {
        public function __construct(){}

        public function __destruct(){}

        public static function setBasePath($base_path){}

        public static function getBasePath(){}

        public static function setLogger($logger){}

        public static function getLastLogger(){}

        public static function setDatetimeFormat($format){}

        public static function getDatetimeFormat(){}

        public static function analyzerCount($level, $log_path = null, $key_word = null){}

        public static function analyzerDetail($level, $log_path = null, $key_word = null, $start = null, $limit = null, $order = null){}

        public static function getBuffer(){}

        public static function flushBuffer(){}

        public static function log($level, $message = null, $content = null, $logger = null){}

        public static function debug($message, $content = null, $logger = null){}

        public static function info($message, $content = null, $logger = null){}

        public static function notice($message, $content = null, $logger = null){}

        public static function warning($message, $content = null, $logger = null){}

        public static function error($message, $content = null, $logger = null){}

        public static function critical($message, $content = null, $logger = null){}

        public static function alert($message, $content = null, $logger = null){}

        public static function emergency($message, $content = null, $logger = null){}
    }
}

