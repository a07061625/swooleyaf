<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/8/22 0022
 * Time: 16:51
 */
namespace SyModule;

use Constant\ErrorCode;
use Exception\Swoole\ServerException;
use SyServer\BaseServer;
use Traits\SimpleTrait;

abstract class ModuleBase {
    use SimpleTrait;

    const NODE_TYPE_HTTP = 'http';
    const NODE_TYPE_RPC = 'rpc';

    /**
     * 模块标识
     * @var string
     */
    protected $moduleBase = '';
    /**
     * 模块名称
     * @var string
     */
    protected $moduleName = '';

    protected function init() {
    }

    /**
     * 通过节点类型设置节点信息
     * @param string $nodeType 节点类型
     * @param array $nodeInfo 节点信息
     */
    private function setNodeInfoByType(string $nodeType,array &$nodeInfo) {
        if ($nodeType == self::NODE_TYPE_HTTP) {
            $nodeInfo['url'] = 'http://' . $nodeInfo['host'] . ':' . $nodeInfo['port'];
        }
    }

    /**
     * 获取节点服务信息
     * @param string $nodeType 节点类型
     * @return array
     * @throws \Exception\Swoole\ServerException
     */
    private function getNodeServerInfo(string $nodeType) {
        $serviceInfo = BaseServer::getServiceInfo($this->moduleBase);
        if (empty($serviceInfo)) {
            throw new ServerException('服务不存在', ErrorCode::SWOOLE_SERVER_NOT_EXIST_ERROR);
        }

        $nodeInfo = [
            'port' => $serviceInfo['port'],
            'host' => $serviceInfo['host'],
        ];
        $this->setNodeInfoByType($nodeType, $nodeInfo);

        return $nodeInfo;
    }

    /**
     * 获取http服务信息
     * 返回数据结构如下：
     * [
     *     'host' => '127.0.0.1',
     *     'port' => 89,
     *     'url' => 'http://127.0.0.1:89/xxx',
     * ]
     * @param string $uri 请求uri
     * @param array  $params 数据参数数组
     * @return array
     */
    protected function getHttpServerInfo(string $uri,array $params=[]) {
        $nodeInfo = $this->getNodeServerInfo(self::NODE_TYPE_HTTP);
        $nodeInfo['url'] .= $uri;
        if(!empty($params)){
            if (strpos($uri, '?') === false) {
                $nodeInfo['url'] .= '?' . http_build_query($params);
            } else {
                $nodeInfo['url'] .= '&' . http_build_query($params);
            }
        }

        return $nodeInfo;
    }

    /**
     * 获取rpc服务信息
     * 返回数据结构如下：
     * [
     *     'host' => '127.0.0.1',
     *     'port' => 89,
     * ]
     * @return array
     */
    protected function getRpcServerInfo() {
        $nodeInfo = $this->getNodeServerInfo(self::NODE_TYPE_RPC);

        return $nodeInfo;
    }
}