<?php
/**
 * 搜索店铺
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetFieldsTrait;
use SyPromotion\TBK\Traits\SetPageNoTrait;
use SyPromotion\TBK\Traits\SetPageSizeTrait;
use SyPromotion\TBK\Traits\SetPlatformTrait;

/**
 * Class ShopGet
 *
 * @package SyPromotion\TBK\Promoter
 */
class ShopGet extends BaseTBK
{
    use SetFieldsTrait;
    use SetPlatformTrait;
    use SetPageNoTrait;
    use SetPageSizeTrait;

    /**
     * 返回字段列表
     *
     * @var array
     */
    private $fields = [];
    /**
     * 查询关键词
     *
     * @var string
     */
    private $q = '';
    /**
     * 排序
     *
     * @var string
     */
    private $sort = '';
    /**
     * 淘宝商城店铺标识,true:淘宝商城的店铺 false:不判断这个属性
     *
     * @var bool
     */
    private $is_tmall = false;
    /**
     * 最低信用等级
     *
     * @var int
     */
    private $start_credit = 0;
    /**
     * 最高信用等级
     *
     * @var int
     */
    private $end_credit = 0;
    /**
     * 最低淘客佣金比率
     *
     * @var int
     */
    private $start_commission_rate = 0;
    /**
     * 最高淘客佣金比率
     *
     * @var int
     */
    private $end_commission_rate = 0;
    /**
     * 最小店铺商品总数
     *
     * @var int
     */
    private $start_total_action = 0;
    /**
     * 最大店铺商品总数
     *
     * @var int
     */
    private $end_total_action = 0;
    /**
     * 最小累计推广商品数
     *
     * @var int
     */
    private $start_auction_count = 0;
    /**
     * 最大累计推广商品数
     *
     * @var int
     */
    private $end_auction_count = 0;
    /**
     * 链接形式 1:PC 2:无线 默认１
     *
     * @var int
     */
    private $platform = 0;
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

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.shop.get');
        $this->reqData['platform'] = 1;
        $this->reqData['is_tmall'] = false;
        $this->reqData['page_no'] = 1;
        $this->reqData['page_size'] = 20;
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setQuery(string $keyword)
    {
        $trueKeyword = trim($keyword);
        if (\strlen($trueKeyword) > 0) {
            $this->reqData['q'] = $trueKeyword;
        } else {
            throw new TBKException('查询关键词不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setSort(string $sortField, string $sortType)
    {
        if (!\in_array($sortField, ['commission_rate', 'auction_count', 'total_auction'])) {
            throw new TBKException('排序字段不支持', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!\in_array($sortType, ['asc', 'des'])) {
            throw new TBKException('排序类型不支持', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        $this->reqData['sort'] = $sortField . '_' . $sortType;
    }

    public function setIsTmall(bool $isTmall)
    {
        $this->reqData['is_tmall'] = $isTmall;
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setStartCredit(int $startCredit)
    {
        if (($startCredit >= 1) && ($startCredit <= 20)) {
            $this->reqData['start_credit'] = $startCredit;
        } else {
            throw new TBKException('最低信用等级不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setEndCredit(int $endCredit)
    {
        if (($endCredit >= 1) && ($endCredit <= 20)) {
            $this->reqData['end_credit'] = $endCredit;
        } else {
            throw new TBKException('最高信用等级不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setStartCommissionRate(int $startCommissionRate)
    {
        if (($startCommissionRate >= 1) && ($startCommissionRate <= 10000)) {
            $this->reqData['start_commission_rate'] = $startCommissionRate;
        } else {
            throw new TBKException('最低淘客佣金比率不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setEndCommissionRate(int $endCommissionRate)
    {
        if (($endCommissionRate >= 1) && ($endCommissionRate <= 10000)) {
            $this->reqData['end_commission_rate'] = $endCommissionRate;
        } else {
            throw new TBKException('最高淘客佣金比率不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setStartTotalAction(int $startTotalAction)
    {
        if ($startTotalAction > 0) {
            $this->reqData['start_total_action'] = $startTotalAction;
        } else {
            throw new TBKException('最小店铺商品总数不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setEndTotalAction(int $endTotalAction)
    {
        if ($endTotalAction > 0) {
            $this->reqData['end_total_action'] = $endTotalAction;
        } else {
            throw new TBKException('最大店铺商品总数不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setStartAuctionCount(int $startAuctionCount)
    {
        if ($startAuctionCount > 0) {
            $this->reqData['start_auction_count'] = $startAuctionCount;
        } else {
            throw new TBKException('最小累计推广商品数不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setEndAuctionCount(int $endAuctionCount)
    {
        if ($endAuctionCount > 0) {
            $this->reqData['end_auction_count'] = $endAuctionCount;
        } else {
            throw new TBKException('最大累计推广商品数不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['fields'])) {
            throw new TBKException('返回字段列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['q'])) {
            throw new TBKException('查询关键词不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
