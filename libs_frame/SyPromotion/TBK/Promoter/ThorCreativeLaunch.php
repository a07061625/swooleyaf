<?php
/**
 * 媒体智能化投放
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class ThorCreativeLaunch
 *
 * @package SyPromotion\TBK\Promoter
 */
class ThorCreativeLaunch extends BaseTBK
{
    /**
     * 请求ID
     *
     * @var string
     */
    private $id = '';
    /**
     * 版本号
     *
     * @var int
     */
    private $version = 0;
    /**
     * 设备信息
     *
     * @var array
     */
    private $device = [];
    /**
     * 推广位id
     *
     * @var string
     */
    private $adzone_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.thor.creative.launch');
        $this->reqData['req'] = [
            'version' => 1,
        ];
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setId(string $id)
    {
        if (ctype_alnum($id)) {
            $this->reqData['req']['id'] = $id;
        } else {
            throw new TBKException('请求ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setDevice(array $device)
    {
        if (empty($device)) {
            throw new TBKException('设备信息不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $this->reqData['req']['device'] = $device;
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setAdZoneId(string $adZoneId)
    {
        if (ctype_alnum($adZoneId)) {
            $this->reqData['req']['adzone_id'] = $adZoneId;
        } else {
            throw new TBKException('推广位id不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['req']['id'])) {
            throw new TBKException('请求ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['req']['device'])) {
            throw new TBKException('设备信息不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['req']['adzone_id'])) {
            throw new TBKException('推广位id不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
