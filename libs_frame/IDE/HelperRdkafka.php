<?php
namespace {
    define('RD_KAFKA_CONSUMER', 1);
    define('RD_KAFKA_OFFSET_BEGINNING', -2);
    define('RD_KAFKA_OFFSET_END', -1);
    define('RD_KAFKA_OFFSET_STORED', -1000);
    define('RD_KAFKA_PARTITION_UA', -1);
    define('RD_KAFKA_PRODUCER', 0);
    define('RD_KAFKA_VERSION', 591104);
    define('RD_KAFKA_BUILD_VERSION', 591104);
    define('RD_KAFKA_RESP_ERR__BEGIN', -200);
    define('RD_KAFKA_RESP_ERR__BAD_MSG', -199);
    define('RD_KAFKA_RESP_ERR__BAD_COMPRESSION', -198);
    define('RD_KAFKA_RESP_ERR__DESTROY', -197);
    define('RD_KAFKA_RESP_ERR__FAIL', -196);
    define('RD_KAFKA_RESP_ERR__TRANSPORT', -195);
    define('RD_KAFKA_RESP_ERR__CRIT_SYS_RESOURCE', -194);
    define('RD_KAFKA_RESP_ERR__RESOLVE', -193);
    define('RD_KAFKA_RESP_ERR__MSG_TIMED_OUT', -192);
    define('RD_KAFKA_RESP_ERR__PARTITION_EOF', -191);
    define('RD_KAFKA_RESP_ERR__UNKNOWN_PARTITION', -190);
    define('RD_KAFKA_RESP_ERR__FS', -189);
    define('RD_KAFKA_RESP_ERR__UNKNOWN_TOPIC', -188);
    define('RD_KAFKA_RESP_ERR__ALL_BROKERS_DOWN', -187);
    define('RD_KAFKA_RESP_ERR__INVALID_ARG', -186);
    define('RD_KAFKA_RESP_ERR__TIMED_OUT', -185);
    define('RD_KAFKA_RESP_ERR__QUEUE_FULL', -184);
    define('RD_KAFKA_RESP_ERR__ISR_INSUFF', -183);
    define('RD_KAFKA_RESP_ERR__NODE_UPDATE', -182);
    define('RD_KAFKA_RESP_ERR__SSL', -181);
    define('RD_KAFKA_RESP_ERR__WAIT_COORD', -180);
    define('RD_KAFKA_RESP_ERR__UNKNOWN_GROUP', -179);
    define('RD_KAFKA_RESP_ERR__IN_PROGRESS', -178);
    define('RD_KAFKA_RESP_ERR__PREV_IN_PROGRESS', -177);
    define('RD_KAFKA_RESP_ERR__EXISTING_SUBSCRIPTION', -176);
    define('RD_KAFKA_RESP_ERR__ASSIGN_PARTITIONS', -175);
    define('RD_KAFKA_RESP_ERR__REVOKE_PARTITIONS', -174);
    define('RD_KAFKA_RESP_ERR__CONFLICT', -173);
    define('RD_KAFKA_RESP_ERR__STATE', -172);
    define('RD_KAFKA_RESP_ERR__UNKNOWN_PROTOCOL', -171);
    define('RD_KAFKA_RESP_ERR__NOT_IMPLEMENTED', -170);
    define('RD_KAFKA_RESP_ERR__AUTHENTICATION', -169);
    define('RD_KAFKA_RESP_ERR__NO_OFFSET', -168);
    define('RD_KAFKA_RESP_ERR__OUTDATED', -167);
    define('RD_KAFKA_RESP_ERR__TIMED_OUT_QUEUE', -166);
    define('RD_KAFKA_RESP_ERR__UNSUPPORTED_FEATURE', -165);
    define('RD_KAFKA_RESP_ERR__WAIT_CACHE', -164);
    define('RD_KAFKA_RESP_ERR__INTR', -163);
    define('RD_KAFKA_RESP_ERR__KEY_SERIALIZATION', -162);
    define('RD_KAFKA_RESP_ERR__VALUE_SERIALIZATION', -161);
    define('RD_KAFKA_RESP_ERR__KEY_DESERIALIZATION', -160);
    define('RD_KAFKA_RESP_ERR__VALUE_DESERIALIZATION', -159);
    define('RD_KAFKA_RESP_ERR__END', -100);
    define('RD_KAFKA_RESP_ERR_UNKNOWN', -1);
    define('RD_KAFKA_RESP_ERR_NO_ERROR', 0);
    define('RD_KAFKA_RESP_ERR_OFFSET_OUT_OF_RANGE', 1);
    define('RD_KAFKA_RESP_ERR_INVALID_MSG', 2);
    define('RD_KAFKA_RESP_ERR_UNKNOWN_TOPIC_OR_PART', 3);
    define('RD_KAFKA_RESP_ERR_INVALID_MSG_SIZE', 4);
    define('RD_KAFKA_RESP_ERR_LEADER_NOT_AVAILABLE', 5);
    define('RD_KAFKA_RESP_ERR_NOT_LEADER_FOR_PARTITION', 6);
    define('RD_KAFKA_RESP_ERR_REQUEST_TIMED_OUT', 7);
    define('RD_KAFKA_RESP_ERR_BROKER_NOT_AVAILABLE', 8);
    define('RD_KAFKA_RESP_ERR_REPLICA_NOT_AVAILABLE', 9);
    define('RD_KAFKA_RESP_ERR_MSG_SIZE_TOO_LARGE', 10);
    define('RD_KAFKA_RESP_ERR_STALE_CTRL_EPOCH', 11);
    define('RD_KAFKA_RESP_ERR_OFFSET_METADATA_TOO_LARGE', 12);
    define('RD_KAFKA_RESP_ERR_NETWORK_EXCEPTION', 13);
    define('RD_KAFKA_RESP_ERR_GROUP_LOAD_IN_PROGRESS', 14);
    define('RD_KAFKA_RESP_ERR_GROUP_COORDINATOR_NOT_AVAILABLE', 15);
    define('RD_KAFKA_RESP_ERR_NOT_COORDINATOR_FOR_GROUP', 16);
    define('RD_KAFKA_RESP_ERR_TOPIC_EXCEPTION', 17);
    define('RD_KAFKA_RESP_ERR_RECORD_LIST_TOO_LARGE', 18);
    define('RD_KAFKA_RESP_ERR_NOT_ENOUGH_REPLICAS', 19);
    define('RD_KAFKA_RESP_ERR_NOT_ENOUGH_REPLICAS_AFTER_APPEND', 20);
    define('RD_KAFKA_RESP_ERR_INVALID_REQUIRED_ACKS', 21);
    define('RD_KAFKA_RESP_ERR_ILLEGAL_GENERATION', 22);
    define('RD_KAFKA_RESP_ERR_INCONSISTENT_GROUP_PROTOCOL', 23);
    define('RD_KAFKA_RESP_ERR_INVALID_GROUP_ID', 24);
    define('RD_KAFKA_RESP_ERR_UNKNOWN_MEMBER_ID', 25);
    define('RD_KAFKA_RESP_ERR_INVALID_SESSION_TIMEOUT', 26);
    define('RD_KAFKA_RESP_ERR_REBALANCE_IN_PROGRESS', 27);
    define('RD_KAFKA_RESP_ERR_INVALID_COMMIT_OFFSET_SIZE', 28);
    define('RD_KAFKA_RESP_ERR_TOPIC_AUTHORIZATION_FAILED', 29);
    define('RD_KAFKA_RESP_ERR_GROUP_AUTHORIZATION_FAILED', 30);
    define('RD_KAFKA_RESP_ERR_CLUSTER_AUTHORIZATION_FAILED', 31);
    define('RD_KAFKA_RESP_ERR_INVALID_TIMESTAMP', 32);
    define('RD_KAFKA_RESP_ERR_UNSUPPORTED_SASL_MECHANISM', 33);
    define('RD_KAFKA_RESP_ERR_ILLEGAL_SASL_STATE', 34);
    define('RD_KAFKA_RESP_ERR_UNSUPPORTED_VERSION', 35);
    define('RD_KAFKA_RESP_ERR_TOPIC_ALREADY_EXISTS', 36);
    define('RD_KAFKA_RESP_ERR_INVALID_PARTITIONS', 37);
    define('RD_KAFKA_RESP_ERR_INVALID_REPLICATION_FACTOR', 38);
    define('RD_KAFKA_RESP_ERR_INVALID_REPLICA_ASSIGNMENT', 39);
    define('RD_KAFKA_RESP_ERR_INVALID_CONFIG', 40);
    define('RD_KAFKA_RESP_ERR_NOT_CONTROLLER', 41);
    define('RD_KAFKA_RESP_ERR_INVALID_REQUEST', 42);
    define('RD_KAFKA_RESP_ERR_UNSUPPORTED_FOR_MESSAGE_FORMAT', 43);
    define('RD_KAFKA_CONF_UNKNOWN', -2);
    define('RD_KAFKA_CONF_INVALID', -1);
    define('RD_KAFKA_CONF_OK', 0);
    define('RD_KAFKA_MSG_PARTITIONER_RANDOM', 2);
    define('RD_KAFKA_MSG_PARTITIONER_CONSISTENT', 3);
    define('RD_KAFKA_LOG_PRINT', 100);
    define('RD_KAFKA_LOG_SYSLOG', 101);
    define('RD_KAFKA_LOG_SYSLOG_PRINT', 102);
}

namespace  {
    abstract class RdKafka {
        /* properties */
        private $error_cb = null;
        private $dr_cb = null;

        public function addBrokers($broker_list){}

        public function getMetadata($all_topics, $only_topic = null, $timeout_ms = null){}

        public function getOutQLen(){}

        public function metadata($all_topics, $only_topic = null, $timeout_ms = null){}

        public function setLogLevel($level){}

        public function newQueue(){}

        public function newTopic($topic_name, $topic_conf = null){}

        public function outqLen(){}

        public function poll($timeout_ms){}

        public function setLogger($logger){}

        public function __destruct(){}
    }
}

namespace RdKafka {
    class Consumer extends \RdKafka {
        public function __construct($conf = null){}

        public function addBrokers($broker_list){}

        public function getMetadata($all_topics, $only_topic = null, $timeout_ms = null){}

        public function getOutQLen(){}

        public function metadata($all_topics, $only_topic = null, $timeout_ms = null){}

        public function setLogLevel($level){}

        public function newQueue(){}

        public function newTopic($topic_name, $topic_conf = null){}

        public function outqLen(){}

        public function poll($timeout_ms){}

        public function setLogger($logger){}

        public function __destruct(){}
    }

    class Producer extends \RdKafka {
        public function __construct($conf = null){}

        public function addBrokers($broker_list){}

        public function getMetadata($all_topics, $only_topic = null, $timeout_ms = null){}

        public function getOutQLen(){}

        public function metadata($all_topics, $only_topic = null, $timeout_ms = null){}

        public function setLogLevel($level){}

        public function newQueue(){}

        /**
         * @param string $topic_name
         * @param array $topic_conf
         * @return ProducerTopic
         */
        public function newTopic($topic_name, $topic_conf = null){}

        public function outqLen(){}

        public function poll($timeout_ms){}

        public function setLogger($logger){}

        public function __destruct(){}
    }

    class Exception extends \Exception implements \Throwable {
        /* properties */
        protected $message = '';
        protected $code = 0;
        protected $file = null;
        protected $line = null;

        final private function __clone(){}

        public function __construct($message = null, $code = null, $previous = null){}

        public function __wakeup(){}

        public function __toString(){}
    }

    class Conf {
        public function __construct(){}

        public function dump(){}

        public function set($name, $value){}

        public function setDefaultTopicConf($topic_conf){}

        public function setErrorCb($callback){}

        public function setDrMsgCb($callback){}

        public function setRebalanceCb($callback){}
    }

    class TopicConf {
        public function __construct(){}

        public function dump(){}

        public function set(){}

        public function setPartitioner($partitioner){}
    }

    class KafkaConsumer {
        /* properties */
        private $error_cb = null;
        private $rebalance_cb = null;
        private $dr_msg_cb = null;

        public function __construct($conf){}

        public function assign($topic_partitions = null){}

        public function getAssignment(){}

        public function commit($message_or_offsets = null){}

        public function commitAsync($message_or_offsets = null){}

        public function consume($timeout_ms){}

        public function subscribe($topics){}

        public function getSubscription(){}

        public function unsubscribe(){}

        public function getMetadata($all_topics, $only_topic, $timeout_ms){}

        public function newTopic($topic_name, $topic_conf = null){}
    }

    class Message {
        /* properties */
        public $err = null;
        public $topic_name = null;
        public $partition = null;
        public $payload = null;
        public $key = null;
        public $offset = null;

        public function errstr(){}
    }

    class Metadata {
        public function getOrigBrokerId(){}

        public function getOrigBrokerName(){}

        public function getBrokers(){}

        public function getTopics(){}
    }

    class TopicPartition {
        public function __construct(){}

        public function getTopic(){}

        public function setTopic($topic_name){}

        public function getPartition(){}

        public function setPartition($partition){}

        public function getOffset(){}

        public function setOffset($offset){}
    }

    class Queue {
        private function __construct(){}

        public function consume($timeout_ms){}
    }

    abstract class Topic {
        public function getName(){}
    }

    class ConsumerTopic extends \RdKafka\Topic {
        private function __construct(){}

        public function consumeQueueStart($partition, $offset, $queue){}

        public function consumeStart($partition, $offset){}

        public function consumeStop($partition){}

        public function consume($partition, $timeout_ms){}

        public function offsetStore($partition, $offset){}

        public function getName(){}
    }

    class KafkaConsumerTopic extends \RdKafka\Topic {
        private function __construct(){}

        public function offsetStore($partition, $offset){}

        public function getName(){}
    }

    class ProducerTopic extends \RdKafka\Topic {
        private function __construct(){}

        public function produce($partition, $msgflags, $payload, $key = null){}

        public function getName(){}
    }
}

namespace RdKafka\Metadata {
    class Topic {
        public function getTopic(){}

        public function getPartitions(){}

        public function getErr(){}
    }

    class Broker {
        public function getId(){}

        public function getHost(){}

        public function getPort(){}
    }

    class Partition {
        public function getId(){}

        public function getErr(){}

        public function getLeader(){}

        public function getReplicas(){}

        public function getIsrs(){}
    }

    class Collection implements \Countable, \Iterator {
        public function count(){}

        public function current(){}

        public function key(){}

        public function next(){}

        public function rewind(){}

        public function valid(){}
    }
}

