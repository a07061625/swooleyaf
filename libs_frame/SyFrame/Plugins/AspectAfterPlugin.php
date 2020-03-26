<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/5/24 0024
 * Time: 22:11
 */
namespace SyFrame\Plugins;

use SyConstant\SyInner;
use SyLog\Log;
use Yaf\Plugin_Abstract;
use Yaf\Registry;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;

class AspectAfterPlugin extends Plugin_Abstract
{
    /**
     * 切面标识数组
     * @var array
     */
    private $aspectMap = [];

    public function __construct()
    {
        $this->aspectMap = [];
    }

    private function __clone()
    {
    }

    private function getAspectList()
    {
        $aspectKey = $_SERVER['SYKEY-CA'];
        $aspectTag = $this->aspectMap[$aspectKey] ?? null;
        if (is_null($aspectTag)) {
            $aspectTag = hash('crc32b', $aspectKey);
            $this->aspectMap[$aspectKey] = $aspectTag;
        }
        return [
            'tag' => $aspectTag,
            'list' => Registry::get(SyInner::REGISTRY_NAME_PREFIX_ASPECT_AFTER . $aspectTag),
        ];
    }

    /**
     * @param \Yaf\Request_Abstract $request
     * @param \Yaf\Response_Abstract $response
     * @return void
     */
    public function postDispatch(Request_Abstract $request, Response_Abstract $response)
    {
        $aspectList = $this->getAspectList();
        foreach ($aspectList['list'] as $aspectName) {
            $aspectName::handleAfter();
        }

        $logStr = $request->getControllerName() . 'Controller::' . $request->getActionName() . 'Action exit' . PHP_EOL
                  . 'memory_usage: ' . memory_get_usage() . PHP_EOL
                  . 'use_time: ' . (microtime(true) - $_SERVER['SYSTART_' . $aspectList['tag']]) . 's';
        Log::log($logStr);
    }
}
