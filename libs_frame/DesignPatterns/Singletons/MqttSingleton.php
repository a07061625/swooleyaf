<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/3/11 0011
 * Time: 17:04
 */

namespace DesignPatterns\Singletons;

use SyMessageQueue\Mqtt\Connection;
use SyTrait\SingletonTrait;

/**
 * Class MqttSingleton
 *
 * @package DesignPatterns\Singletons
 */
class MqttSingleton
{
    use SingletonTrait;

    /**
     * @var null|\SyMessageQueue\Mqtt\Connection
     */
    private $conn;

    private function __construct(array $will)
    {
        $this->conn = new Connection($will);
    }

    /**
     * @param array $will 延迟配置
     *
     * @return \DesignPatterns\Singletons\MqttSingleton
     */
    public static function getInstance(array $will = []): self
    {
        if (null === self::$instance) {
            self::$instance = new self($will);
        }

        return self::$instance;
    }

    public function getConn(): Connection
    {
        return $this->conn;
    }
}
