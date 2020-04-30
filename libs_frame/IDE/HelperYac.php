<?php
namespace {
    define('YAC_VERSION', '2.2.0');
    define('YAC_MAX_KEY_LEN', 48);
    define('YAC_MAX_VALUE_RAW_LEN', 67108863);
    define('YAC_MAX_RAW_COMPRESSED_LEN', 1048576);
    define('YAC_SERIALIZER_PHP', 0);
    define('YAC_SERIALIZER_JSON', 1);
    define('YAC_SERIALIZER_MSGPACK', 2);
    define('YAC_SERIALIZER_IGBINARY', 3);
    define('YAC_SERIALIZER', 0);
}

namespace  {
    class Yac {
        /* properties */
        protected $_prefix = '';

        public function __construct($prefix = null){}

        public function add($keys, $value = null, $ttl = null){}

        public function set($keys, $value = null, $ttl = null){}

        public function __set($key, $value){}

        public function get($keys){}

        public function __get($key){}

        public function delete($keys, $ttl = null){}

        public function flush(){}

        public function info(){}

        public function dump(){}
    }
}

