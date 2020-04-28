<?php
namespace {
    define('MESSAGEPACK_OPT_PHPONLY', -1001);
}

namespace  {
    class MessagePack {
        /* constants */
        const OPT_PHPONLY = -1001;

        public function __construct($opt = null){}

        public function setOption($option, $value){}

        public function pack($value){}

        public function unpack($str, $object = null){}

        public function unpacker(){}
    }

    class MessagePackUnpacker {
        public function __construct($opt = null){}

        public function __destruct(){}

        public function setOption($option, $value){}

        public function feed($str){}

        public function execute($str = null, &$offset = null){}

        public function data($object = null){}

        public function reset(){}
    }
}

namespace {
    /**
     * @param $value [required]
     */
    function msgpack_serialize($value){}

    /**
     * @param $str [required]
     * @param $object [optional]
     */
    function msgpack_unserialize($str, $object=null){}

    /**
     * @param $value [required]
     */
    function msgpack_pack($value){}

    /**
     * @param $str [required]
     * @param $object [optional]
     */
    function msgpack_unpack($str, $object=null){}
}
