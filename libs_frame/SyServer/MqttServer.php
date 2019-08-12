<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/20 0020
 * Time: 16:40
 */
namespace SyServer;

use Tool\MqttTool;

class MqttServer
{
    /**
     * @var \swoole_server
     */
    protected $_server = null;

    public function __construct()
    {
        $this->_server = new \swoole_server('0.0.0.0', 9501);
        $this->_server->set([
            'worker_num' => 8,
            'daemonize' => false,
            'max_request' => 10000,
            'open_mqtt_protocol' => true,
            'dispatch_mode' => 2,
            'debug_mode' => 1,
        ]);
    }

    public function __clone()
    {
    }

    public function start()
    {
        $this->_server->on('start', [$this, 'onStart']);
        $this->_server->on('connect', [$this, 'onConnect']);
        $this->_server->on('receive', [$this, 'onReceive']);
        $this->_server->on('close', [$this, 'onClose']);
        $this->_server->on('workerStart', [$this, 'onWorkerStart']);
        $this->_server->start();
    }

    public function onStart(\swoole_server $server)
    {
    }

    public function onWorkerStart(\swoole_server $server, $workerId)
    {
    }

    public function onConnect(\swoole_server $server, int $fd, int $reactorId)
    {
    }

    public function onReceive(\swoole_server $server, int $fd, int $reactor_id, string $data)
    {
        $_SERVER = [
            'SY_MSG_TYPE' => (ord($data[0]) & 0xF0) >> 4,
            'SY_MSG_LENGTH' => MqttTool::getMsgLength($data),
        ];

        switch ($_SERVER['SY_MSG_TYPE']) {
            case 1: //CONNECT
                $resp = chr(32) . chr(2) . chr(0) . chr(0);//转换为二进制返回应该使用chr
                $client_info = $this->get_connect_info(substr($data, 2));
                $client_id = $client_info['clientId'];
                $serv->send($fd, $resp);
                $this->debug("Send CONNACK");
                break;
            case 3: //PUBLISH
                $fix_header['dup'] = ($byte & 0x08) >> 3;
                $fix_header['qos'] = ($byte & 0x06) >> 1;
                $fix_header['retain'] = $byte & 0x01;
                $offset = 2;
                $topic = $this->decodeString(substr($data, $offset));
                $offset += strlen($topic) + 2;
                $msg = substr($data, $offset);
                echo "client msg: $topic\n---------------------------------\n$msg\n---------------------------------\n";
                $client_id = $this->redis_get("client_" . $fd);
                break;
            case 8: //SUBSCRIBE
                //id有可能是两个字节的,这个需要更多的测试
                //                $msg_id = ord($data[2]);
                $msg_id = ord($data[3]);
                $fix_header['sign'] = ($byte & 0x02) >> 1;
                $qos = ord($data[$fix_header['data_len'] + 1]);
                if ($fix_header['sign'] == 1) {
                    echo "this is subscribe message!!!!\n";
                    $this->debug($msg_id, "msg id");
                    $this->debug($qos, "QOS");
                    //这里没有从协议中读取topic的长度,按照固定的写做6
                    $topic = substr($data, 6, $fix_header['data_len'] - 1);
                    $this->debug($topic, "topic");
                }
                //订阅后返回
                $resp = chr(0x90) . chr(3) . chr(0) . chr($msg_id) . chr(0);
                $this->printstr($resp);
                $serv->send($fd, $resp);
                $this->debug("send SUBACK");
                break;
            case 10: //UNSUBSCRIBE
                break;
            case 12: //PINGREQ
                $resp = chr(208) . chr(0);//转换为二进制返回应该使用chr
                //保存最后ping的时间
                $serv->send($fd, $resp);
                $this->debug("Send PINGRESP");
                break;
            case 14: //DISCONNECT
                break;
        }
    }

    public function onClose(\swoole_server $server, int $fd, int $reactorId)
    {
    }
}
