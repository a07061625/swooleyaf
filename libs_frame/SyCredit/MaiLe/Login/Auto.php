<?php
/**
 * 获取免登录URL
 * User: 姜伟
 * Date: 2020/4/21 0021
 * Time: 14:46
 */
namespace SyCredit\MaiLe\Login;

use SyConstant\ErrorCode;
use SyCredit\BaseMaiLe;
use SyCredit\UtilMaiLe;
use SyException\Credit\MaiLeException;
use SyTool\Tool;

/**
 * Class Auto
 * @package SyCredit\MaiLe\Login
 */
class Auto extends BaseMaiLe
{
    /**
     * 用户id
     * @var string
     */
    private $uid = '';
    /**
     * 渠道标识
     * @var string
     */
    private $channel = '';
    /**
     * 用户积分
     * @var int
     */
    private $credits = 0;
    /**
     * 商品ID
     * @var int
     */
    private $goodsId = 0;
    /**
     * 是否跳转至兑换记录页 0:不跳转 1:跳转
     * @var int
     */
    private $isJumpRecord = 0;
    /**
     * 是否隐藏导航栏 0:不隐藏 1:隐藏
     * @var int
     */
    private $isHiddenNavBar = 0;
    /**
     * 会员等级 0-39
     * @var int
     */
    private $vip = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqData['timeStamp'] = Tool::getNowTime();
    }

    private function __clone()
    {
    }

    /**
     * @param string $uid
     * @throws \SyException\Credit\MaiLeException
     */
    public function setUid(string $uid)
    {
        if (ctype_alnum($uid)) {
            $this->reqData['uid'] = $uid;
        } else {
            throw new MaiLeException('用户id不合法', ErrorCode::CREDIT_PARAM_ERROR);
        }
    }

    /**
     * @param string $channel
     * @throws \SyException\Credit\MaiLeException
     */
    public function setChannel(string $channel)
    {
        if (ctype_alnum($channel)) {
            $this->reqData['channel'] = $channel;
        } else {
            throw new MaiLeException('渠道标识不合法', ErrorCode::CREDIT_PARAM_ERROR);
        }
    }

    /**
     * @param int $credits
     * @throws \SyException\Credit\MaiLeException
     */
    public function setCredits(int $credits)
    {
        if ($credits >= 0) {
            $this->reqData['credits'] = $credits;
        } else {
            throw new MaiLeException('用户积分不合法', ErrorCode::CREDIT_PARAM_ERROR);
        }
    }

    /**
     * @param int $goodsId
     * @throws \SyException\Credit\MaiLeException
     */
    public function setGoodsId(int $goodsId)
    {
        if ($goodsId > 0) {
            $this->reqData['goodsId'] = $goodsId;
        } else {
            throw new MaiLeException('商品ID不合法', ErrorCode::CREDIT_PARAM_ERROR);
        }
    }

    /**
     * @param int $isJumpRecord
     * @throws \SyException\Credit\MaiLeException
     */
    public function setIsJumpRecord(int $isJumpRecord)
    {
        if (in_array($isJumpRecord, [0, 1])) {
            $this->reqData['isJumpRecord'] = $isJumpRecord;
        } else {
            throw new MaiLeException('兑换记录页跳转标识不合法', ErrorCode::CREDIT_PARAM_ERROR);
        }
    }

    /**
     * @param int $isHiddenNavBar
     * @throws \SyException\Credit\MaiLeException
     */
    public function setIsHiddenNavBar(int $isHiddenNavBar)
    {
        if (in_array($isHiddenNavBar, [0, 1])) {
            $this->reqData['isHiddenNavBar'] = $isHiddenNavBar;
        } else {
            throw new MaiLeException('导航栏隐藏标识不合法', ErrorCode::CREDIT_PARAM_ERROR);
        }
    }

    /**
     * @param int $vip
     * @throws \SyException\Credit\MaiLeException
     */
    public function setVip(int $vip)
    {
        if (($vip >= 0) && ($vip <= 39)) {
            $this->reqData['vip'] = $vip;
        } else {
            throw new MaiLeException('会员等级不合法', ErrorCode::CREDIT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['uid'])) {
            throw new MaiLeException('用户id不能为空', ErrorCode::CREDIT_PARAM_ERROR);
        }
        if (!isset($this->reqData['credits'])) {
            throw new MaiLeException('用户积分不能为空', ErrorCode::CREDIT_PARAM_ERROR);
        }
        UtilMaiLe::createSign($this->reqData);

        return [
            'login_url' => 'https://h5.mailejifen.com/login/auto?' . http_build_query($this->reqData),
        ];
    }
}
