<?php
/**
 * 创建淘礼金
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetAdZoneIdTrait;

/**
 * Class VegasTljCreate
 *
 * @package SyPromotion\TBK\Promoter
 */
class VegasTljCreate extends BaseTBK
{
    use SetAdZoneIdTrait;

    /**
     * CPS佣金计划类型
     *
     * @var string
     */
    private $campaign_type = '';
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
     * 安全校验标识
     *
     * @var bool
     */
    private $security_switch = false;
    /**
     * 单个淘礼金面额
     *
     * @var int
     */
    private $per_face = 0;
    /**
     * 发放开始时间
     *
     * @var int
     */
    private $send_start_time = 0;
    /**
     * 发放截止时间
     *
     * @var int
     */
    private $send_end_time = 0;
    /**
     * 使用结束日期
     *
     * @var int
     */
    private $use_end_time = 0;
    /**
     * 结束日期模式
     *
     * @var int
     */
    private $use_end_time_mode = 0;
    /**
     * 使用开始日期
     *
     * @var int
     */
    private $use_start_time = 0;
    /**
     * 安全等级
     *
     * @var int
     */
    private $security_level = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.dg.vegas.tlj.create');
        $this->reqData['security_switch'] = true;
        $this->reqData['security_level'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setCampaignType(string $campaignType)
    {
        if (\in_array($campaignType, ['DX', 'LINK_EVENT', 'MKT'])) {
            $this->reqData['campaign_type'] = $campaignType;
        } else {
            throw new TBKException('CPS佣金计划类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
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

    public function setSecuritySwitch(bool $securitySwitch)
    {
        $this->reqData['security_switch'] = $securitySwitch;
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

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setSendStartTime(int $sendStartTime)
    {
        if ($sendStartTime > 1262275200) {
            $this->reqData['send_start_time'] = date('Y-m-d H:i:s', $sendStartTime);
        } else {
            throw new TBKException('发放开始时间不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setSendEndTime(int $sendEndTime)
    {
        if ($sendEndTime > 1262275200) {
            $this->reqData['send_end_time'] = date('Y-m-d H:i:s', $sendEndTime);
        } else {
            throw new TBKException('发放截止时间不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setUseEndTime(int $mode, int $time)
    {
        if ((1 == $mode) && ($time >= 1) && ($time <= 7)) {
            $this->reqData['use_end_time'] = $time;
            $this->reqData['use_end_time_mode'] = $mode;
        } elseif ((2 == $mode) && ($time > 1262275200)) {
            $this->reqData['use_end_time'] = date('Y-m-d', $time);
            $this->reqData['use_end_time_mode'] = $mode;
        } else {
            throw new TBKException('使用结束日期不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setUseStartTime(int $useStartTime)
    {
        if ($useStartTime > 1262275200) {
            $this->reqData['use_start_time'] = date('Y-m-d', $useStartTime);
        } else {
            throw new TBKException('使用开始日期不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setSecurityLevel(int $securityLevel)
    {
        if (\in_array($securityLevel, [0, 1])) {
            $this->reqData['security_level'] = $securityLevel;
        } else {
            throw new TBKException('安全等级不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
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
        if (!isset($this->reqData['send_start_time'])) {
            throw new TBKException('发放开始时间不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
