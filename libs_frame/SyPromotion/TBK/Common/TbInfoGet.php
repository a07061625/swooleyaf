<?php
/**
 * 判定用户是否为手淘注册用户
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:38
 */

namespace SyPromotion\TBK\Common;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class TbInfoGet
 *
 * @package SyPromotion\TBK\Common
 */
class TbInfoGet extends BaseTBK
{
    /**
     * 平台类型
     *
     * @var string
     */
    private $platform = '';
    /**
     * 设备ID
     *
     * @var string
     */
    private $device_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.tbinfo.get');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPlatform(string $platform)
    {
        if (\in_array($platform, ['android', 'ios'])) {
            $this->reqData['platform'] = $platform;
        } else {
            throw new TBKException('平台类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setDeviceId(string $deviceId)
    {
        if (\strlen($deviceId) > 0) {
            $this->reqData['device_id'] = md5($deviceId);
        } else {
            throw new TBKException('设备ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['platform'])) {
            throw new TBKException('平台类型不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['device_id'])) {
            throw new TBKException('设备ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
