<?php
/**
 * 淘礼金发放及使用报表
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class VegasTljInstanceReport
 *
 * @package SyPromotion\TBK\Promoter
 */
class VegasTljInstanceReport extends BaseTBK
{
    /**
     * 实例ID
     *
     * @var string
     */
    private $rights_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.dg.vegas.tlj.instance.report');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setRightsId(string $rightsId)
    {
        if (\strlen($rightsId) > 0) {
            $this->reqData['rights_id'] = $rightsId;
        } else {
            throw new TBKException('实例ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['rights_id'])) {
            throw new TBKException('实例ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
