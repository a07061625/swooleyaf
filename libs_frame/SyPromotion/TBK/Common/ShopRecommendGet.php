<?php
/**
 * 获取店铺关联推荐
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:38
 */

namespace SyPromotion\TBK\Common;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetFieldsTrait;
use SyPromotion\TBK\Traits\SetPlatformTrait;

/**
 * Class ShopRecommendGet
 *
 * @package SyPromotion\TBK\Common
 */
class ShopRecommendGet extends BaseTBK
{
    use SetFieldsTrait;
    use SetPlatformTrait;

    /**
     * 返回字段列表
     *
     * @var array
     */
    private $fields = [];
    /**
     * 卖家Id
     *
     * @var int
     */
    private $user_id = 0;
    /**
     * 返回数量
     *
     * @var int
     */
    private $count = 0;
    /**
     * 链接形式 1:PC 2:无线 默认１
     *
     * @var int
     */
    private $platform = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.shop.recommend.get');
        $this->reqData['count'] = 20;
        $this->reqData['platform'] = 1;
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setUserId(int $userId)
    {
        if ($userId > 0) {
            $this->reqData['user_id'] = $userId;
        } else {
            throw new TBKException('卖家Id不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setCount(int $count)
    {
        if (($count >= 1) && ($count <= 40)) {
            $this->reqData['count'] = $count;
        } else {
            throw new TBKException('返回数量不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['fields'])) {
            throw new TBKException('返回字段列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['user_id'])) {
            throw new TBKException('卖家Id不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
