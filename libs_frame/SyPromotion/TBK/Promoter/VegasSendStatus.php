<?php
/**
 * 查询超级红包领取状态
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class VegasSendStatus
 *
 * @package SyPromotion\TBK\Promoter
 */
class VegasSendStatus extends BaseTBK
{
    /**
     * 会员运营id
     *
     * @var string
     */
    private $special_id = '';
    /**
     * 渠道管理id
     *
     * @var string
     */
    private $relation_id = '';
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

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.dg.vegas.send.status');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setSpecialId(string $specialId)
    {
        if (\strlen($specialId) > 0) {
            $this->reqData['special_id'] = $specialId;
        } else {
            throw new TBKException('会员运营id不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
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
            throw new TBKException('渠道管理id不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
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
        if (\in_array($deviceType, ['IMEI', 'IDFA', 'OAID', 'MOBILE', 'ALIPAY_ID'])) {
            $this->reqData['device_type'] = $deviceType;
        } else {
            throw new TBKException('入参类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        return $this->getContent();
    }
}
