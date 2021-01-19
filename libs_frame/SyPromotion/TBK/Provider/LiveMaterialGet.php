<?php
/**
 * 直播物料精选
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Provider;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetAdZoneIdTrait;
use SyPromotion\TBK\Traits\SetDeviceEncryptTrait;
use SyPromotion\TBK\Traits\SetDeviceTypeTrait;
use SyPromotion\TBK\Traits\SetDeviceValueTrait;
use SyPromotion\TBK\Traits\SetSiteIdTrait;

/**
 * Class LiveMaterialGet
 *
 * @package SyPromotion\TBK\Provider
 */
class LiveMaterialGet extends BaseTBK
{
    use SetSiteIdTrait;
    use SetDeviceValueTrait;
    use SetDeviceEncryptTrait;
    use SetDeviceTypeTrait;
    use SetAdZoneIdTrait;

    /**
     * 网站ID
     *
     * @var int
     */
    private $site_id = 0;
    /**
     * 设备号加密值
     *
     * @var string
     */
    private $device_value = '';
    /**
     * 设备号加密类型
     *
     * @var string
     */
    private $device_encrypt = '';
    /**
     * 设备号类型
     *
     * @var string
     */
    private $device_type = '';
    /**
     * 页数
     *
     * @var int
     */
    private $page_num = 0;
    /**
     * 每页记录数
     *
     * @var int
     */
    private $page_size = 0;
    /**
     * 渠道关系ID
     *
     * @var int
     */
    private $relation_id = 0;
    /**
     * 广告位ID
     *
     * @var int
     */
    private $adzone_id = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.sc.live.material.get');
        $this->reqData['page_num'] = 1;
        $this->reqData['page_size'] = 10;
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPageNum(int $pageNum)
    {
        if ($pageNum > 0) {
            $this->reqData['page_num'] = $pageNum;
        } else {
            throw new TBKException('页数不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPageSize(int $pageSize)
    {
        if (($pageSize > 0) && ($pageSize <= 20)) {
            $this->reqData['page_size'] = $pageSize;
        } else {
            throw new TBKException('每页记录数不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setRelationId(int $relationId)
    {
        if ($relationId > 0) {
            $this->reqData['relation_id'] = $relationId;
        } else {
            throw new TBKException('渠道关系ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['site_id'])) {
            throw new TBKException('网站ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['adzone_id'])) {
            throw new TBKException('广告位ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
