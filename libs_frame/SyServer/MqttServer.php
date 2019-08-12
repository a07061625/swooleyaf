<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/20 0020
 * Time: 16:40
 */
namespace SyServer;

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
    }

    public function onClose(\swoole_server $server, int $fd, int $reactorId)
    {
    }
}
