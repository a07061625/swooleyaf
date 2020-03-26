<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/20 0020
 * Time: 16:40
 */
namespace SyServer;

use Swoole\Server;
use SyTool\MqttTool;

class MqttServer
{
    /**
     * @var \Swoole\Server
     */
    protected $_server = null;

    public function __construct()
    {
        $this->_server = new Server('0.0.0.0', 9501);
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

    public function onStart(Server $server)
    {
    }

    public function onWorkerStart(Server $server, $workerId)
    {
    }

    public function onConnect(Server $server, int $fd, int $reactorId)
    {
    }

    public function onReceive(Server $server, int $fd, int $reactor_id, string $data)
    {
        $byte = ord($data[0]);
        $_POST = [];
        $_SERVER = [
            'SY_MSG_TYPE' => ($byte & 0xF0) >> 4,
            'SY_MSG_LENGTH' => MqttTool::getMsgLength($data),
        ];

        switch ($_SERVER['SY_MSG_TYPE']) {
            case 1: //CONNECT
                $rspContent = chr(32) . chr(2) . chr(0) . chr(0);
                $server->send($fd, $rspContent);
                break;
            case 3: //PUBLISH
                $_SERVER['SY_DUP'] = ($byte & 0x08) >> 3;
                $_SERVER['SY_QOS'] = ($byte & 0x06) >> 1;
                $_SERVER['SY_RETAIN'] = $byte & 0x01;
                $offset = 2;
                $_POST['msg_topic'] = MqttTool::decodeStr(substr($data, $offset));
                $offset += strlen($_POST['msg_topic']) + 2;
                $_POST['msg_content'] = substr($data, $offset);
                break;
            case 8: //SUBSCRIBE
                $_SERVER['SY_SIGN'] = ($byte & 0x02) >> 1;
                $_POST['msg_id'] = ord($data[3]);
                $_POST['msg_topic'] = $_SERVER['SY_SIGN'] == 1 ? substr($data, 6, ($_SERVER['SY_MSG_LENGTH'] - 1)) : '';
                //订阅后返回
                $rspContent = chr(0x90) . chr(3) . chr(0) . chr($_POST['msg_id']) . chr(0);
                $server->send($fd, $rspContent);
                break;
            case 10: //UNSUBSCRIBE
                break;
            case 12: //PINGREQ
                $rspContent = chr(208) . chr(0);
                $server->send($fd, $rspContent);
                break;
            case 14: //DISCONNECT
                break;
        }
    }

    public function onClose(Server $server, int $fd, int $reactorId)
    {
    }
}
