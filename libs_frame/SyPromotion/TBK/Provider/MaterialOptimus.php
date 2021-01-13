<?php
/**
 * 物料精选
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
use SyPromotion\TBK\Traits\SetMaterialIdTrait;
use SyPromotion\TBK\Traits\SetPageNo2Trait;
use SyPromotion\TBK\Traits\SetPageSizeTrait;
use SyPromotion\TBK\Traits\SetSiteIdTrait;

/**
 * Class MaterialOptimus
 *
 * @package SyPromotion\TBK\Provider
 */
class MaterialOptimus extends BaseTBK
{
    use SetPageNo2Trait;
    use SetPageSizeTrait;
    use SetAdZoneIdTrait;
    use SetMaterialIdTrait;
    use SetSiteIdTrait;
    use SetDeviceValueTrait;
    use SetDeviceEncryptTrait;
    use SetDeviceTypeTrait;

    /**
     * 页数
     *
     * @var int
     */
    private $page_no = 0;
    /**
     * 每页记录数
     *
     * @var int
     */
    private $page_size = 0;
    /**
     * 广告位ID
     *
     * @var int
     */
    private $adzone_id = 0;
    /**
     * 物料ID
     *
     * @var int
     */
    private $material_id = 0;
    /**
     * 站点ID
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
     * 内容详情ID
     *
     * @var int
     */
    private $content_id = 0;
    /**
     * 内容渠道信息
     *
     * @var string
     */
    private $content_source = '';
    /**
     * 商品ID
     *
     * @var int
     */
    private $item_id = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.sc.optimus.material');
        $this->reqData['page_no'] = 1;
        $this->reqData['page_size'] = 20;
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setContentId(int $contentId)
    {
        if ($contentId > 0) {
            $this->reqData['content_id'] = $contentId;
        } else {
            throw new TBKException('内容详情ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setContentSource(string $contentSource)
    {
        if (\strlen($contentSource) > 0) {
            $this->reqData['content_source'] = $contentSource;
        } else {
            throw new TBKException('内容渠道信息不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setItemId(int $itemId)
    {
        if ($itemId > 0) {
            $this->reqData['item_id'] = $itemId;
        } else {
            throw new TBKException('商品ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['adzone_id'])) {
            throw new TBKException('广告位ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['material_id'])) {
            throw new TBKException('物料ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['site_id'])) {
            throw new TBKException('站点ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
