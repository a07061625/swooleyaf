<?php
/**
 * 管理店铺
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
 * Class ShopManage
 *
 * @package SyPromotion\TBK\Kol
 */
class ShopManage extends BaseTBK
{
    /**
     * 店铺背景图
     *
     * @var string
     */
    private $background_image = '';
    /**
     * 店铺图标
     *
     * @var string
     */
    private $store_icon = '';
    /**
     * 店铺名称
     *
     * @var string
     */
    private $store_name = '';
    /**
     * 达人pid
     *
     * @var string
     */
    private $pid = '';
    /**
     * 操作标识
     *
     * @var string
     */
    private $operation_type_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.kol.shop.manage');
        $this->reqData['operation_type_id'] = 'shop.create';
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setBackgroundImage(string $backgroundImage)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $backgroundImage) > 0) {
            $this->reqData['background_image'] = $backgroundImage;
        } else {
            throw new TBKException('店铺背景图不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setStoreIcon(string $storeIcon)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $storeIcon) > 0) {
            $this->reqData['store_icon'] = $storeIcon;
        } else {
            throw new TBKException('店铺图标不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setStoreName(string $storeName)
    {
        if (\strlen($storeName) > 0) {
            $this->reqData['store_name'] = $storeName;
        } else {
            throw new TBKException('店铺名称不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
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

    public function getDetail(): array
    {
        if (!isset($this->reqData['background_image'])) {
            throw new TBKException('店铺背景图不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['store_icon'])) {
            throw new TBKException('店铺图标不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['store_name'])) {
            throw new TBKException('店铺名称不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['pid'])) {
            throw new TBKException('达人pid不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
