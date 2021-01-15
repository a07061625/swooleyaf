<?php
/**
 * 查询处罚订单
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyTool\Tool;

/**
 * Class PunishOrderGet
 *
 * @package SyPromotion\TBK\Promoter
 */
class PunishOrderGet extends BaseTBK
{
    /**
     * 请求参数
     *
     * @var array
     */
    private $af_order_option = [];

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.dg.punish.order.get');
        $this->reqData['af_order_option'] = Tool::jsonEncode([
            'page_no' => 1,
            'page_size' => 20,
        ], JSON_UNESCAPED_UNICODE);
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setAfOrderOption(array $afOrderOption)
    {
        $trueOption = [];
        $siteId = \is_int($afOrderOption['site_id']) ? $afOrderOption['site_id'] : 0;
        if (0 != $siteId) {
            if ($siteId > 0) {
                $trueOption['site_id'] = $siteId;
            } else {
                throw new TBKException('网站ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
            }
        }

        $span = \is_int($afOrderOption['span']) ? $afOrderOption['span'] : 0;
        if (0 != $span) {
            if (($span > 0) && ($span <= 30)) {
                $trueOption['span'] = $span;
            } else {
                throw new TBKException('查询时间跨度不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
            }
        }

        $relationId = \is_int($afOrderOption['relation_id']) ? $afOrderOption['relation_id'] : 0;
        if (0 != $relationId) {
            if ($relationId > 0) {
                $trueOption['relation_id'] = $relationId;
            } else {
                throw new TBKException('渠道关系ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
            }
        }

        $tbTradeId = \is_string($afOrderOption['tb_trade_id']) ? $afOrderOption['tb_trade_id'] : '';
        if (\strlen($tbTradeId) > 0) {
            if (ctype_digit($tbTradeId)) {
                $trueOption['tb_trade_id'] = $tbTradeId;
            } else {
                throw new TBKException('子订单号不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
            }
        }

        $pageSize = \is_int($afOrderOption['page_size']) ? $afOrderOption['page_size'] : 20;
        if (($pageSize > 0) && ($pageSize <= 100)) {
            $trueOption['page_size'] = $pageSize;
        } else {
            throw new TBKException('每页记录数不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $pageNo = \is_int($afOrderOption['page_no']) ? $afOrderOption['page_no'] : 1;
        if ($pageNo > 0) {
            $trueOption['page_no'] = $pageNo;
        } else {
            throw new TBKException('页数不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $startTime = \is_int($afOrderOption['start_time']) ? $afOrderOption['start_time'] : 0;
        if (0 != $startTime) {
            if ($startTime > 0) {
                $trueOption['start_time'] = date('Y-m-d H:i:s', $startTime);
            } else {
                throw new TBKException('查询开始时间不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
            }
        }

        $adZoneId = \is_int($afOrderOption['adzone_id']) ? $afOrderOption['adzone_id'] : 0;
        if (0 != $adZoneId) {
            if ($adZoneId > 0) {
                $trueOption['adzone_id'] = $adZoneId;
            } else {
                throw new TBKException('广告位ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
            }
        }

        $this->reqData['af_order_option'] = Tool::jsonEncode($trueOption, JSON_UNESCAPED_UNICODE);
    }

    public function getDetail(): array
    {
        return $this->getContent();
    }
}
