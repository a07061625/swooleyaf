<?php
/**
 * 获取商品展示规则
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class ItemRuleGet
 *
 * @package SyPromotion\TBK\Promoter
 */
class ItemRuleGet extends BaseTBK
{
    /**
     * 商品ID列表
     *
     * @var array
     */
    private $itemIds = [];
    /**
     * 媒体上下文用户ID
     *
     * @var string
     */
    private $isvUserId = '';
    /**
     * 商品信息列表
     *
     * @var array
     */
    private $itemsData = [];

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('qimen.taobao.tbk.item.rule.get');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setItemList(array $itemList)
    {
        $trueItemList = [];
        foreach ($itemList as $eItem) {
            $itemId = \is_int($eItem['id']) && ($eItem['id'] > 0) ? $eItem['id'] : 0;
            $itemInfo = \is_array($eItem['info']) && !empty($eItem['info']) ? $eItem['info'] : [];
            if (($itemId > 0) && !empty($itemInfo)) {
                $trueItemList[$itemId] = $itemInfo;
            }
        }
        if (empty($trueItemList)) {
            throw new TBKException('商品列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $this->reqData['itemIds'] = implode(',', array_keys($trueItemList));
        $this->reqData['itemsData'] = array_values($trueItemList);
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setIsvUserId(string $isvUserId)
    {
        if (\strlen($isvUserId) > 0) {
            $this->reqData['isvUserId'] = $isvUserId;
        } else {
            throw new TBKException('媒体上下文用户ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['itemIds'])) {
            throw new TBKException('商品ID列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
