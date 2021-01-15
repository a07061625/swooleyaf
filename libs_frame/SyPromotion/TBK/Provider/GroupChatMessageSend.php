<?php
/**
 * 手淘群发单
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Provider;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetDxTrait;

/**
 * Class GroupChatMessageSend
 *
 * @package SyPromotion\TBK\Provider
 */
class GroupChatMessageSend extends BaseTBK
{
    use SetDxTrait;

    /**
     * 淘客pid
     *
     * @var string
     */
    private $pid = '';
    /**
     * 群组id列表
     *
     * @var array
     */
    private $group_ids = [];
    /**
     * 商品id
     *
     * @var int
     */
    private $item_id = 0;
    /**
     * 券id
     *
     * @var string
     */
    private $activity_id = '';
    /**
     * 加密e参数
     *
     * @var string
     */
    private $me = '';
    /**
     * 强制定向
     *
     * @var string
     */
    private $dx = '';
    /**
     * 消息文本
     *
     * @var string
     */
    private $text = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.sc.groupchat.message.send');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPid(string $pid)
    {
        if (\strlen($pid) > 0) {
            $this->reqData['pid'] = $pid;
        } else {
            throw new TBKException('淘客pid不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setGroupIds(array $groupIds)
    {
        $groupIdList = [];
        foreach ($groupIds as $eGroupId) {
            if (\is_string($eGroupId) && (\strlen($eGroupId) > 0)) {
                $groupIdList[$eGroupId] = 1;
            }
        }
        if (empty($groupIdList)) {
            throw new TBKException('群组id列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $this->reqData['group_ids'] = implode(',', array_keys($groupIdList));
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setItemId(int $itemId)
    {
        if ($itemId > 0) {
            $this->reqData['item_id'] = $itemId;
        } else {
            throw new TBKException('商品id不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setActivityId(string $activityId)
    {
        if (\strlen($activityId) > 0) {
            $this->reqData['activity_id'] = $activityId;
        } else {
            throw new TBKException('券id不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setMe(string $me)
    {
        if (\strlen($me) > 0) {
            $this->reqData['me'] = $me;
        } else {
            throw new TBKException('加密e参数不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setText(string $text)
    {
        if (\strlen($text) > 0) {
            $this->reqData['text'] = $text;
        } else {
            throw new TBKException('消息文本不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['pid'])) {
            throw new TBKException('淘客pid不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['group_ids'])) {
            throw new TBKException('群组id列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
