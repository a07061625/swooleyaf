<?php
/**
 * 定向投放链接
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class DtGet
 *
 * @package SyPromotion\TBK\Promoter
 */
class DtGet extends BaseTBK
{
    /**
     * 设备类型
     *
     * @var string
     */
    private $device_type = '';
    /**
     * 设备id
     *
     * @var string
     */
    private $device_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.dt.get');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setDeviceType(string $deviceType)
    {
        if (\in_array($deviceType, ['IDFA', 'IMEI'])) {
            $this->reqData['device_type'] = $deviceType;
        } else {
            throw new TBKException('设备类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setDeviceId(string $deviceId)
    {
        if ((32 == \strlen($deviceId)) && ctype_alnum($deviceId)) {
            $this->reqData['device_id'] = strtolower($deviceId);
        } else {
            throw new TBKException('设备id不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['device_type'])) {
            throw new TBKException('设备类型不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['device_id'])) {
            throw new TBKException('设备id不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
