<?php
/**
 * 创建推广者位
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Provider;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetSiteIdTrait;

/**
 * Class AdZoneCreate
 *
 * @package SyPromotion\TBK\Provider
 */
class AdZoneCreate extends BaseTBK
{
    use SetSiteIdTrait;

    /**
     * 网站ID
     *
     * @var int
     */
    private $site_id = 0;
    /**
     * 广告位名称
     *
     * @var string
     */
    private $adzone_name = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.sc.adzone.create');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setAdZoneName(string $adZoneName)
    {
        $nameLength = \strlen($adZoneName);
        if (($nameLength > 0) && ($nameLength <= 64)) {
            $this->reqData['adzone_name'] = $adZoneName;
        } else {
            throw new TBKException('广告位名称不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['site_id'])) {
            throw new TBKException('网站ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['adzone_name'])) {
            throw new TBKException('广告位名称不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
