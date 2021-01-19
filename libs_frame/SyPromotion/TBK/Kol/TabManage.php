<?php
/**
 * 频道管理
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Kol;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class TabManage
 *
 * @package SyPromotion\TBK\Kol
 */
class TabManage extends BaseTBK
{
    /**
     * 达人pid
     *
     * @var string
     */
    private $pid = '';
    /**
     * 频道名称
     *
     * @var string
     */
    private $tab_name = '';
    /**
     * 商品ID列表
     *
     * @var array
     */
    private $item_list = [];
    /**
     * 操作类型
     *
     * @var string
     */
    private $operation_type_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.kol.tab.manage');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPid(string $pid)
    {
        if (preg_match(ProjectBase::REGEX_PROMOTION_TBK_PID, $pid) > 0) {
            $this->reqData['pid'] = $pid;
        } else {
            throw new TBKException('达人pid不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setTabName(string $tabName)
    {
        if (\strlen($tabName) > 0) {
            $this->reqData['tab_name'] = $tabName;
        } else {
            throw new TBKException('频道名称不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setItemList(array $itemList)
    {
        $items = [];
        foreach ($itemList as $eItemId) {
            if (\is_int($eItemId) && ($eItemId > 0)) {
                $items[$eItemId] = 1;
            }
        }
        if (0 == \count($items)) {
            throw new TBKException('商品ID列表不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $this->reqData['item_list'] = array_keys($items);
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setOperationTypeId(string $operationTypeId)
    {
        if (\strlen($operationTypeId) > 0) {
            $this->reqData['operation_type_id'] = $operationTypeId;
        } else {
            throw new TBKException('操作类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['pid'])) {
            throw new TBKException('达人pid不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['operation_type_id'])) {
            throw new TBKException('操作类型不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
