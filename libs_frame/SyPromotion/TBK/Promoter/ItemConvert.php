<?php
/**
 * 商品链接转换
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetAdZoneIdTrait;
use SyPromotion\TBK\Traits\SetDxTrait;
use SyPromotion\TBK\Traits\SetFieldsTrait;
use SyPromotion\TBK\Traits\SetNumIidsTrait;
use SyPromotion\TBK\Traits\SetPlatformTrait;
use SyPromotion\TBK\Traits\SetUnidTrait;

/**
 * Class ItemConvert
 *
 * @package SyPromotion\TBK\Promoter
 */
class ItemConvert extends BaseTBK
{
    use SetFieldsTrait;
    use SetNumIidsTrait;
    use SetAdZoneIdTrait;
    use SetPlatformTrait;
    use SetDxTrait;
    use SetUnidTrait;

    /**
     * 返回字段列表
     *
     * @var array
     */
    private $fields = [];
    /**
     * 商品ID列表
     *
     * @var array
     */
    private $num_iids = [];
    /**
     * 广告位ID
     *
     * @var int
     */
    private $adzone_id = 0;
    /**
     * 链接形式 1:PC 2:无线 默认１
     *
     * @var int
     */
    private $platform = 0;
    /**
     * 推广渠道
     *
     * @var string
     */
    private $unid = '';
    /**
     * 计划链接
     *
     * @var string
     */
    private $dx = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.item.convert');
        $this->reqData['platform'] = 1;
        $this->reqData['dx'] = '1';
    }

    private function __clone()
    {
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['fields'])) {
            throw new TBKException('返回字段列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['num_iids'])) {
            throw new TBKException('商品ID列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['adzone_id'])) {
            throw new TBKException('广告位ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
