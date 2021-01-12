<?php
/**
 * 转换店铺三方分成链接
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetAdZoneIdTrait;
use SyPromotion\TBK\Traits\SetFieldsTrait;
use SyPromotion\TBK\Traits\SetPlatformTrait;
use SyPromotion\TBK\Traits\SetSubPidTrait;
use SyPromotion\TBK\Traits\SetUnidTrait;

/**
 * Class ShopShareConvert
 *
 * @package SyPromotion\TBK\Promoter
 */
class ShopShareConvert extends BaseTBK
{
    use SetFieldsTrait;
    use SetPlatformTrait;
    use SetAdZoneIdTrait;
    use SetSubPidTrait;
    use SetUnidTrait;

    /**
     * 返回字段列表
     *
     * @var array
     */
    private $fields = [];
    /**
     * 卖家ID列表
     *
     * @var array
     */
    private $user_ids = [];
    /**
     * 链接形式 1:PC 2:无线 默认１
     *
     * @var int
     */
    private $platform = 0;
    /**
     * 广告位ID
     *
     * @var int
     */
    private $adzone_id = 0;
    /**
     * 三方pid
     *
     * @var string
     */
    private $sub_pid = '';
    /**
     * 推广渠道
     *
     * @var string
     */
    private $unid = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.shop.share.convert');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setUserIds(array $userIds)
    {
        $userIdList = [];
        foreach ($userIds as $eUserId) {
            if (\is_int($eUserId) && ($eUserId > 0)) {
                $userIdList[$eUserId] = 1;
            }
        }
        if (empty($userIdList)) {
            throw new TBKException('卖家ID列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $this->reqData['user_ids'] = implode(',', array_keys($userIdList));
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['fields'])) {
            throw new TBKException('返回字段列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['user_ids'])) {
            throw new TBKException('卖家ID列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['adzone_id'])) {
            throw new TBKException('广告位ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['sub_pid'])) {
            throw new TBKException('三方pid不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
