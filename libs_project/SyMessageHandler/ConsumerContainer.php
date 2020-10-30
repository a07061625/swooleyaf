<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 21:28
 */
namespace SyMessageHandler;

use SyMessageHandler\Consumers\ContainerFrame;
use SyTool\BaseContainer;

/**
 * Class ConsumerContainer
 *
 * @package SyMessageHandler
 */
class ConsumerContainer extends BaseContainer
{
    /**
     * @var \SyMessageHandler\Consumers\ContainerFrame
     */
    private $frameContainer;

    public function __construct()
    {
        $this->frameContainer = new ContainerFrame();
        $this->registryMap = [];
    }

    /**
     * 获取绑定类
     *
     * @param string|int $tag 对象类型标识
     *
     * @return null|mixed
     */
    public function getObj($tag)
    {
        $obj = $this->frameContainer->getObj($tag);
        if (is_null($obj)) {
            $obj = parent::getObj($tag);
        }

        return $obj;
    }
}
