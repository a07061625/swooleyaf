<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-26
 * Time: 0:53
 */
namespace Validator\Containers;

use SyTool\BaseContainer;

class ValidatorContainer extends BaseContainer
{
    /**
     * @var \Validator\Containers\FrameContainer
     */
    private $frameContainer;

    public function __construct()
    {
        $this->frameContainer = new FrameContainer();
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
