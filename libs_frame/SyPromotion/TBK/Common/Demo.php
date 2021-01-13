<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:38
 */
namespace SyPromotion\TBK\Common;

use SyPromotion\BaseTBK;

/**
 * Class Demo
 * @package SyPromotion\TBK\Common
 */
class Demo extends BaseTBK
{
    public function __construct()
    {
        parent::__construct();
        $this->setMethod('111111');
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
