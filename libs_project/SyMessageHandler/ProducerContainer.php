<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 21:27
 */
namespace SyMessageHandler;

use SyTool\BaseContainer;

/**
 * Class ProducerContainer
 * @package SyMessageHandler
 */
class ProducerContainer extends BaseContainer
{
    /**
     * @var \SyMessageHandler\ProducerContainerFrame
     */
    private $frameContainer = null;

    public function __construct()
    {
        $this->frameContainer = new ProducerContainerFrame();
        $this->registryMap = [];
    }

    /**
     * 获取绑定类
     * @param string|int $tag 对象类型标识
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