<?php
/**
 * 判定商品是否在可锁佣跟踪池内及奖励池收益指数
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Provider;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class LockInCheckGet
 *
 * @package SyPromotion\TBK\Provider
 */
class LockInCheckGet extends BaseTBK
{
    /**
     * 加密值
     *
     * @var string
     */
    private $device_value = '';
    /**
     * 入参类型
     *
     * @var string
     */
    private $device_type = '';
    /**
     * 商品ID
     *
     * @var string
     */
    private $item_id = '';
    /**
     * 会员运营ID
     *
     * @var string
     */
    private $special_id = '';
    /**
     * 渠道关系ID
     *
     * @var string
     */
    private $relation_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.sc.lockin.check.get');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setDeviceValue(string $deviceValue)
    {
        if ((32 == \strlen($deviceValue)) && ctype_alnum($deviceValue)) {
            $this->reqData['device_value'] = $deviceValue;
        } else {
            throw new TBKException('加密值不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setDeviceType(string $deviceType)
    {
        if (\in_array($deviceType, ['IMEI', 'IDFA', 'OAID', '联系方式', 'ALIPAY_ID'])) {
            $this->reqData['device_type'] = $deviceType;
        } else {
            throw new TBKException('入参类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setItemId(string $itemId)
    {
        if (ctype_digit($itemId)) {
            $this->reqData['item_id'] = $itemId;
        } else {
            throw new TBKException('商品ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setSpecialId(string $specialId)
    {
        if (\strlen($specialId) > 0) {
            $this->reqData['special_id'] = $specialId;
        } else {
            throw new TBKException('会员运营ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setRelationId(string $relationId)
    {
        if (\strlen($relationId) > 0) {
            $this->reqData['relation_id'] = $relationId;
        } else {
            throw new TBKException('渠道关系ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['item_id'])) {
            throw new TBKException('商品ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if ((!isset($this->reqData['device_type'])) && (!isset($this->reqData['special_id']))
            && !isset($this->reqData['relation_id'])) {
            throw new TBKException('入参类型,会员运营ID,渠道关系ID不能都为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
