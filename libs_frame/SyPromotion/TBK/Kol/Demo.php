<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Kol;

use SyPromotion\BaseTBK;

/**
 * Class Demo
 *
 * @package SyPromotion\TBK\Kol
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

    public function getDetail(): array
    {
        return $this->getContent();
    }
}
