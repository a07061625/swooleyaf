<?php
/**
 * 创建淘礼金
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
 * Class VegasTljCreate
 *
 * @package SyPromotion\TBK\Provider
 */
class VegasTljCreate extends BaseTBK
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
     * 宝贝id
     *
     * @var int
     */
    private $item_id = 0;
    /**
     * 淘礼金总个数
     *
     * @var int
     */
    private $total_num = 0;
    /**
     * 淘礼金名称
     *
     * @var string
     */
    private $name = '';
    /**
     * 单用户累计中奖最大次数
     *
     * @var int
     */
    private $user_total_win_num_limit = 0;
    /**
     * 单个淘礼金面额
     *
     * @var int
     */
    private $per_face = 0;
    /**
     * 网站ID
     *
     * @var int
     */
    private $site_id = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.sc.vegas.tlj.create');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setItemId(int $itemId)
    {
        if ($itemId > 0) {
            $this->reqData['item_id'] = $itemId;
        } else {
            throw new TBKException('宝贝id不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setTotalNum(int $totalNum)
    {
        if ($totalNum > 0) {
            $this->reqData['total_num'] = $totalNum;
        } else {
            throw new TBKException('淘礼金总个数不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setName(string $name)
    {
        $nameLength = \strlen($name);
        if (($nameLength > 0) && ($nameLength <= 10)) {
            $this->reqData['name'] = $name;
        } else {
            throw new TBKException('淘礼金名称不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setUserTotalWinNumLimit(int $userTotalWinNumLimit)
    {
        if ($userTotalWinNumLimit > 0) {
            $this->reqData['user_total_win_num_limit'] = $userTotalWinNumLimit;
        } else {
            throw new TBKException('单用户累计中奖最大次数不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPerFace(int $perFace)
    {
        if ($perFace > 0) {
            $this->reqData['per_face'] = number_format($perFace / 100, 2, '.', '');
        } else {
            throw new TBKException('单个淘礼金面额不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['adzone_id'])) {
            throw new TBKException('广告位id不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['item_id'])) {
            throw new TBKException('宝贝id不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['total_num'])) {
            throw new TBKException('淘礼金总个数不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['name'])) {
            throw new TBKException('淘礼金名称不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['user_total_win_num_limit'])) {
            throw new TBKException('单用户累计中奖最大次数不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['per_face'])) {
            throw new TBKException('单个淘礼金面额不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['site_id'])) {
            throw new TBKException('网站ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
