<?php
/**
 * 手淘群创建
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Provider;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class GroupChatCreate
 *
 * @package SyPromotion\TBK\Provider
 */
class GroupChatCreate extends BaseTBK
{
    /**
     * 群组名称
     *
     * @var string
     */
    private $title = '';
    /**
     * 小群数
     *
     * @var int
     */
    private $sub_group_num = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.sc.groupchat.create');
        $this->reqData['sub_group_num'] = 10;
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setTitle(string $title)
    {
        if (\strlen($title) > 0) {
            $this->reqData['title'] = $title;
        } else {
            throw new TBKException('群组名称不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setSubGroupNum(int $subGroupNum)
    {
        if (($subGroupNum > 0) && ($subGroupNum <= 10)) {
            $this->reqData['sub_group_num'] = $subGroupNum;
        } else {
            throw new TBKException('小群数不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['title'])) {
            throw new TBKException('群组名称不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
