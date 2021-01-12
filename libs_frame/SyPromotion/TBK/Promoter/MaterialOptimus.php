<?php
/**
 * 获取指定物料信息和推广链接
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetAdZoneIdTrait;
use SyPromotion\TBK\Traits\SetPageNo2Trait;
use SyPromotion\TBK\Traits\SetPageSizeTrait;

/**
 * Class MaterialOptimus
 *
 * @package SyPromotion\TBK\Promoter
 */
class MaterialOptimus extends BaseTBK
{
    use SetPageNo2Trait;
    use SetPageSizeTrait;
    use SetAdZoneIdTrait;

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
    /**
     * 选品库投放ID
     *
     * @var string
     */
    private $favorites_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.dg.optimus.material');
        $this->reqData['page_no'] = 1;
        $this->reqData['page_size'] = 20;
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setMaterialId(int $materialId)
    {
        if ($materialId > 0) {
            $this->reqData['material_id'] = $materialId;
        } else {
            throw new TBKException('物料ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setDeviceValue(string $deviceValue)
    {
        if (\strlen($deviceValue) > 0) {
            $this->reqData['device_value'] = $deviceValue;
        } else {
            throw new TBKException('设备号加密值不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function setDeviceEncrypt(string $deviceEncrypt)
    {
        if (\strlen($deviceEncrypt) > 0) {
            $this->reqData['device_encrypt'] = $deviceEncrypt;
        } else {
            unset($this->reqData['device_encrypt']);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setDeviceType(string $deviceType)
    {
        if (\in_array($deviceType, ['IMEI', 'IDFA', 'UTDID', 'OAID'])) {
            $this->reqData['device_type'] = $deviceType;
        } else {
            throw new TBKException('设备号类型不支持', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
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

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setFavoritesId(string $favoritesId)
    {
        if (ctype_alnum($favoritesId)) {
            $this->reqData['favorites_id'] = $favoritesId;
        } else {
            throw new TBKException('选品库投放ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
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

        return $this->getContent();
    }
}
