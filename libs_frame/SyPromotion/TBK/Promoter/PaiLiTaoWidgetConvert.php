<?php
/**
 * 拍立淘插件转链
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetAdZoneIdTrait;

/**
 * Class PaiLiTaoWidgetConvert
 *
 * @package SyPromotion\TBK\Promoter
 */
class PaiLiTaoWidgetConvert extends BaseTBK
{
    use SetAdZoneIdTrait;

    /**
     * 广告位ID
     *
     * @var int
     */
    private $adzone_id = 0;
    /**
     * 渠道id
     *
     * @var int
     */
    private $relation_id = 0;
    /**
     * 类型
     *
     * @var int
     */
    private $type = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.dg.pailitao.widget.convert');
        $this->reqData['type'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setRelationId(int $relationId)
    {
        if ($relationId > 0) {
            $this->reqData['relation_id'] = $relationId;
        } else {
            throw new TBKException('渠道id不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setType(int $type)
    {
        if (\in_array($type, [0, 1])) {
            $this->reqData['type'] = $type;
        } else {
            throw new TBKException('类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['adzone_id'])) {
            throw new TBKException('广告位ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
