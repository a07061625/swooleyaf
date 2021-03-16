<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/3/11 0011
 * Time: 17:12
 */

namespace SyMessageQueue\Mqtt;

use SyConstant\ErrorCode;
use SyException\MessageQueue\MessageQueueException;
use SyTool\Tool;

/**
 * Class Connection
 * 参考: https://github.com/bluerhinos/phpMQTT
 *
 * @package SyMessageQueue\Mqtt
 */
class Connection
{
    /**
     * 客户端ID
     *
     * @var string
     */
    private $clientId = '';
    /**
     * 客户端对象
     *
     * @var null|resource
     */
    private $clientObj;
    /**
     * 延迟数组
     *
     * @var array
     */
    private $will = [];
    /**
     * 连接时间戳
     *
     * @var int
     */
    private $connectTime = 0;
    /**
     * 长连接保持时间
     *
     * @var int
     */
    private $keepaliveTime = 0;
    /**
     * 消息总量
     *
     * @var int
     */
    private $msgCount = 1;
    /**
     * 主体列表
     *
     * @var array
     */
    private $topics = [];

    private static $acceptCommands = [
        1 => 'CONNECT',
        2 => 'CONNACK',
        3 => 'PUBLISH',
        4 => 'PUBACK',
        5 => 'PUBREC',
        6 => 'PUBREL',
        7 => 'PUBCOMP',
        8 => 'SUBSCRIBE',
        9 => 'SUBACK',
        10 => 'UNSUBSCRIBE',
        11 => 'UNSUBACK',
        12 => 'PINGREQ',
        13 => 'PINGRESP',
        14 => 'DISCONNECT',
    ];

    public function __construct(array $will = [])
    {
        $this->clientId = md5(Tool::createNonceStr(8) . Tool::getNowTime());
        $this->will = $will;
        $this->msgCount = 1;
        $this->conn();
    }

    private function __clone()
    {
    }

    public function disConn()
    {
        $head = \chr(0xe0);
        $head .= \chr(0x00);
        fwrite($this->clientObj, $head, 2);
        stream_socket_shutdown($this->clientObj, STREAM_SHUT_WR);
    }

    public function ping()
    {
        $head = \chr(0xc0);
        $head .= \chr(0x00);
        fwrite($this->clientObj, $head, 2);
        $this->connectTime = time();
    }

    public function subscribe(array $topics, int $qos = 0)
    {
        $i = 0;
        $buffer = '';
        $count = $this->msgCount;
        $buffer .= \chr($count >> 8);
        ++$i;
        $buffer .= \chr($count % 256);
        ++$i;

        foreach ($topics as $key => $topic) {
            $buffer .= $this->writeStr($key, $i);
            $buffer .= \chr($topic['qos']);
            ++$i;
            $this->topics[$key] = $topic;
        }

        $cmd = 0x82;
        $cmd += ($qos << 1);

        $head = \chr($cmd);
        $head .= $this->setMsgLength($i);
        fwrite($this->clientObj, $head, \strlen($head));

        $this->writeBuffer($buffer);
        $string = $this->readContent(2);

        $bytes = \ord(substr($string, 1, 1));

        return $this->readContent($bytes);
    }

    public function publish(string $topic, string $content, int $qos = 0, bool $retain = false)
    {
        $i = 0;
        $buffer = '';
        $buffer .= $this->writeStr($topic, $i);

        if ($qos) {
            $count = $this->msgCount++;
            $buffer .= \chr($count >> 8);
            ++$i;
            $buffer .= \chr($count % 256);
            ++$i;
        }

        $buffer .= $content;
        $i += \strlen($content);

        $cmd = 0x30;
        if ($qos) {
            $cmd += $qos << 1;
        }
        if (!empty($retain)) {
            ++$cmd;
        }

        $head = \chr($cmd);
        $head .= $this->setMsgLength($i);

        fwrite($this->clientObj, $head, \strlen($head));
        $this->writeBuffer($buffer);
    }

    public function parseMessage(string $msg): array
    {
        $topicTitleLength = (\ord($msg[0]) << 8) + \ord($msg[1]);

        return [
            'title' => substr($msg, 2, $topicTitleLength),
            'content' => substr($msg, ($topicTitleLength + 2)),
        ];
    }

    public function handleMessage(bool $isLoop = true)
    {
        $this->refreshClient();
        $byte = $this->readContent(1, true);
        if ('' === (string)$byte) {
            if ($isLoop) {
                usleep(100000);
            }
        } else {
            $multiplier = 1;
            $value = 0;
            do {
                $digit = \ord($this->readContent(1));
                $value += ($digit & 127) * $multiplier;
                $multiplier *= 128;
            } while (($digit & 128) !== 0);

            $cmd = (int)(\ord($byte) / 16);
            $msg = $value > 0 ? $this->readContent($value) : '';
            switch ($cmd) {
                case 3: //Publish MSG
                    $this->parseMessage($msg);

                    break;
            }
        }
    }

    private function writeStr($str, &$i): string
    {
        $len = \strlen($str);
        $msb = $len >> 8;
        $lsb = $len % 256;
        $ret = \chr($msb);
        $ret .= \chr($lsb);
        $ret .= $str;
        $i += ($len + 2);

        return $ret;
    }

    private function readContent(int $contentLength = 8192, $isLax = false)
    {
        if ($isLax) {
            return fread($this->clientObj, $contentLength);
        }

        $content = '';
        $nowLength = $contentLength;
        while ((!feof($this->clientObj)) && ($nowLength > 0)) {
            $content .= fread($this->clientObj, $nowLength);
            $nowLength = $contentLength - \strlen($content);
        }

        return $content;
    }

    private function conn(bool $isClean = true)
    {
        $configs = Tool::getConfig('messagequeue.' . SY_ENV . SY_PROJECT . '.mqtt');
        $address = (string)Tool::getArrayVal($configs, 'address', '');
        $port = (int)Tool::getArrayVal($configs, 'port', 1883);
        $cafile = (string)Tool::getArrayVal($configs, 'cafile', '');
        $username = (string)Tool::getArrayVal($configs, 'username', '');
        $password = (string)Tool::getArrayVal($configs, 'password', '');
        $keepalive = (int)Tool::getArrayVal($configs, 'keepalive', 10);
        if (\strlen($cafile) > 0) {
            $socketAddress = 'tls://' . $address . ':' . $port;
            $socketContext = stream_context_create([
                'ssl' => [
                    'verify_peer_name' => true,
                    'cafile' => $cafile,
                ],
            ]);
        } else {
            $socketAddress = 'tcp://' . $address . ':' . $port;
            $socketContext = null;
        }
        $this->clientObj = stream_socket_client($socketAddress, $errNo, $errMsg, 5, STREAM_CLIENT_CONNECT, $socketContext);
        if (!$this->clientObj) {
            throw new MessageQueueException('mqtt连接失败', ErrorCode::MQTT_CONNECTION_ERROR);
        }

        stream_set_timeout($this->clientObj, 5);
        stream_set_blocking($this->clientObj, 0);

        $i = 0;
        $buffer = '';
        $buffer .= \chr(0x00);
        ++$i; // Length MSB
        $buffer .= \chr(0x04);
        ++$i; // Length LSB
        $buffer .= \chr(0x4d);
        ++$i; // M
        $buffer .= \chr(0x51);
        ++$i; // Q
        $buffer .= \chr(0x54);
        ++$i; // T
        $buffer .= \chr(0x54);
        ++$i; // T
        $buffer .= \chr(0x04);
        ++$i; // Protocol Level

        $var = 0;
        if ($isClean) {
            $var += 2;
        }

        //Add will info to header
        if (!empty($this->will)) {
            //Set will flag
            $var += 4;
            //Set will qos
            $var += ($this->will['qos'] << 3);
            //Set will retain
            if ($this->will['retain']) {
                $var += 32;
            }
        }

        //Add username to header
        if (\strlen($username) > 0) {
            $var += 128;
        }
        //Add password to header
        if (\strlen($password) > 0) {
            $var += 64;
        }

        $buffer .= \chr($var);
        ++$i;

        //Keep alive
        $buffer .= \chr($keepalive >> 8);
        ++$i;
        $buffer .= \chr($keepalive & 0xff);
        ++$i;

        $buffer .= $this->writeStr($this->clientId, $i);

        //Adding will to payload
        if (!empty($this->will)) {
            $buffer .= $this->writeStr($this->will['topic'], $i);
            $buffer .= $this->writeStr($this->will['content'], $i);
        }

        if (\strlen($username) > 0) {
            $buffer .= $this->writeStr($username, $i);
        }
        if (\strlen($password)) {
            $buffer .= $this->writeStr($password, $i);
        }

        $head = \chr(0x10);

        while ($i > 0) {
            $encodedByte = $i % 128;
            $i /= 128;
            $i = (int)$i;
            if ($i > 0) {
                $encodedByte |= 128;
            }
            $head .= \chr($encodedByte);
        }

        fwrite($this->clientObj, $head, 2);
        fwrite($this->clientObj, $buffer);

        $content = $this->readContent(4);
        if ((2 === \ord($content[0]) >> 4) && ($content[3] === \chr(0))) {
            $this->connectTime = time();
            $this->keepaliveTime = $keepalive;
        } else {
            throw new MessageQueueException('mqtt认证失败', ErrorCode::MQTT_AUTH_ERROR);
        }
    }

    private function writeBuffer(string $buffer)
    {
        $bufferLength = \strlen($buffer);
        for ($nowLength = 0; $nowLength < $bufferLength; $nowLength += $writeLength) {
            $writeLength = fwrite($this->clientObj, substr($buffer, $nowLength));
            if (false === $writeLength) {
                return false;
            }
        }

        return $bufferLength;
    }

    private function setMsgLength($len): string
    {
        $str = '';
        do {
            $digit = $len % 128;
            $len >>= 7;
            // if there are more digits to encode, set the top bit of this digit
            if ($len > 0) {
                $digit |= 0x80;
            }
            $str .= \chr($digit);
        } while ($len > 0);

        return $str;
    }

    private function refreshClient()
    {
        $refreshTag = 0;
        $nowTime = time();
        if (feof($this->clientObj)) {
            $refreshTag = 1;
        } elseif (($this->connectTime + 2 * $this->keepaliveTime) < $nowTime) {
            $refreshTag = 1;
        } elseif (($this->connectTime + $this->keepaliveTime) < $nowTime) {
            $refreshTag = 2;
        }
        if (1 == $refreshTag) {
            fclose($this->clientObj);
            $this->conn(false);
            if (\count($this->topics) > 0) {
                $this->subscribe($this->topics);
            }
        } elseif (2 == $refreshTag) {
            $this->ping();
        }
    }
}
