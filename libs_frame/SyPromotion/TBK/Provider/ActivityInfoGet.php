<?php
/**
 * 官方活动转链
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Provider;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetAdZoneIdTrait;
use SyPromotion\TBK\Traits\SetSiteIdTrait;

/**
 * Class ActivityInfoGet
 *
 * @package SyPromotion\TBK\Provider
 */
class ActivityInfoGet extends BaseTBK
{
    use SetAdZoneIdTrait;
    use SetSiteIdTrait;

    /**
     * 广告位ID
     *
     * @var int
     */
    private $adzone_id = 0;
    /**
     * 网站ID
     *
     * @var int
     */
    private $site_id = 0;
    /**
     * 渠道关系ID
     *
     * @var int
     */
    private $relation_id = 0;
    /**
     * 官方活动会场ID
     *
     * @var string
     */
    private $activity_material_id = '';
    /**
     * 推广渠道
     *
     * @var string
     */
    private $union_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.sc.activity.info.get');
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
            throw new TBKException('渠道关系ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setActivityMaterialId(string $activityMaterialId)
    {
        if (\strlen($activityMaterialId) > 0) {
            $this->reqData['activity_material_id'] = $activityMaterialId;
        } else {
            throw new TBKException('官方活动会场ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setUnionId(string $unionId)
    {
        if (\strlen($unionId) > 0) {
            $this->reqData['union_id'] = $unionId;
        } else {
            throw new TBKException('推广渠道不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['adzone_id'])) {
            throw new TBKException('广告位ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['site_id'])) {
            throw new TBKException('网站ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['activity_material_id'])) {
            throw new TBKException('官方活动会场ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
