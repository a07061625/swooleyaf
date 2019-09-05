<?php
/**
 * 获取关注者列表
 * User: 姜伟
 * Date: 2018/11/1 0001
 * Time: 10:49
 */
namespace AliPay\Life;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayLifeException;

class FollowList extends AliPayBase
{
    /**
     * 分组用户ID
     * @var string
     */
    private $next_user_id = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.open.public.follow.batchquery');
    }

    private function __clone()
    {
    }

    /**
     * @param string $nextUserId
     * @throws \SyException\AliPay\AliPayLifeException
     */
    public function setNextUserId(string $nextUserId)
    {
        if (ctype_alnum($nextUserId) && (strlen($nextUserId) <= 32)) {
            $this->biz_content['next_user_id'] = $nextUserId;
        } else {
            throw new AliPayLifeException('分组用户ID不合法', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
