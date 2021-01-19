<?php
/**
 * 增加b2c平台用户行为跟踪
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
 * Class TraceB2CAdd
 *
 * @package SyPromotion\TBK\Promoter
 */
class TraceB2CAdd extends BaseTBK
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
     * B2C平台id号 旅行平台:30945035 聚划算:31503084
     *
     * @var int
     */
    private $b2c_id = 0;
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
        $this->setMethod('taobao.tbk.trace.btoc.addtrace');
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
    public function setB2cId(int $b2cId)
    {
        if (\in_array($b2cId, [30945035, 31503084])) {
            $this->reqData['b2c_id'] = $b2cId;
        } else {
            throw new TBKException('B2C平台id号不支持', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
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
        if ((!isset($this->reqData['nick'])) && !isset($this->reqData['uniq_id'])) {
            throw new TBKException('买家昵称和设备编号不能同时为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['b2c_id'])) {
            throw new TBKException('B2C平台id号不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
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
