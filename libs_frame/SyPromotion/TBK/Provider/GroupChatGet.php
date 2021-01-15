<?php
/**
 * 查询手淘群
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Provider;

use SyPromotion\BaseTBK;

/**
 * Class GroupChatGet
 *
 * @package SyPromotion\TBK\Provider
 */
class GroupChatGet extends BaseTBK
{
    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.sc.groupchat.get');
    }

    private function __clone()
    {
    }

    public function getDetail(): array
    {
        return $this->getContent();
    }
}
