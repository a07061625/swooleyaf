<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/11 0011
 * Time: 19:45
 */

namespace SyPromotion\TBK\Traits;

/**
 * Trait SetDxTrait
 *
 * @package SyPromotion\TBK\Traits
 */
trait SetDxTrait
{
    public function setDx(string $dx)
    {
        $this->reqData['dx'] = trim($dx);
    }
}
