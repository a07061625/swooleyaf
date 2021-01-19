<?php
/**
 * 增加用户使用淘宝推广的店铺和宝贝行为跟踪
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetTrackIdTypeTrait;
use SyPromotion\TBK\Traits\SetUniqIdTrait;

/**
 * Class TraceShopItemAdd
 *
 * @package SyPromotion\TBK\Promoter
 */
class TraceShopItemAdd extends BaseTBK
{
    use SetUniqIdTrait;
    use SetTrackIdTypeTrait;

    /**
     * 淘宝买家昵称
     *
     * @var string
     */
    private $nick = '';
    /**
     * 买家无线设备唯一永久编号
     *
     * @var string
     */
    private $uniq_id = '';
    /**
     * 淘宝卖家Id
     *
     * @var int
     */
    private $seller_id = 0;
    /**
     * 商品Id
     *
     * @var int
     */
    private $item_id = 0;
    /**
     * 宝贝所属平台类型 1:淘宝 2:天猫
     *
     * @var int
     */
    private $user_type = 0;
    /**
     * 淘客pid
     *
     * @var string
     */
    private $pid = '';
    /**
     * 平台类型 1:pc 2:mobile 3:TV
     *
     * @var int
     */
    private $track_id_type = 0;
    /**
     * 调用者ID
     *
     * @var string
     */
    private $invoker_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.trace.shopitem.addtrace');
        $this->reqData['item_id'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setNick(string $nick)
    {
        if (\strlen($nick) > 0) {
            $this->reqData['nick'] = $nick;
        } else {
            throw new TBKException('买家昵称不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setSellerId(int $sellerId)
    {
        if ($sellerId > 0) {
            $this->reqData['seller_id'] = $sellerId;
        } else {
            throw new TBKException('卖家Id不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setItemId(int $itemId)
    {
        if ($itemId >= 0) {
            $this->reqData['item_id'] = $itemId;
        } else {
            throw new TBKException('商品Id不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setUserType(int $userType)
    {
        if (\in_array($userType, [1, 2])) {
            $this->reqData['user_type'] = $userType;
        } else {
            throw new TBKException('宝贝所属平台类型不支持', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPid(string $pid)
    {
        if (preg_match(ProjectBase::REGEX_PROMOTION_TBK_PID, $pid) > 0) {
            $this->reqData['pid'] = $pid;
        } else {
            throw new TBKException('淘客pid不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setInvokerId(string $invokerId)
    {
        if (ctype_alnum($invokerId)) {
            $this->reqData['invoker_id'] = $invokerId;
        } else {
            throw new TBKException('调用者ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['nick'])) {
            throw new TBKException('买家昵称不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['uniq_id'])) {
            throw new TBKException('设备编号不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['seller_id'])) {
            throw new TBKException('卖家Id不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['user_type'])) {
            throw new TBKException('宝贝所属平台类型不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['pid'])) {
            throw new TBKException('淘客pid不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['track_id_type'])) {
            throw new TBKException('平台类型不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['invoker_id'])) {
            throw new TBKException('调用者ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
