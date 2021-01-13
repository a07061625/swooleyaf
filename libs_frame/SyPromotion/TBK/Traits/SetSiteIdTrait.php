<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/13 0013
 * Time: 16:51
 */

namespace SyPromotion\TBK\Traits;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;

/**
 * Trait SetSiteIdTrait
 *
 * @package SyPromotion\TBK\Traits
 */
trait SetSiteIdTrait
{
    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setSiteId(int $siteId)
    {
        if ($siteId > 0) {
            $this->reqData['site_id'] = $siteId;
        } else {
            throw new TBKException('网站ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }
}
