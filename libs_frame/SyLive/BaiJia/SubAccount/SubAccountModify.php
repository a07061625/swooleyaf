<?php
/**
 * 修改子账号配置
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 13:42
 */
namespace SyLive\BaiJia\SubAccount;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;
use SyTool\Tool;

/**
 * Class SubAccountModify
 * @package SyLive\BaiJia\SubAccount
 */
class SubAccountModify extends BaseBaiJia
{
    /**
     * 子账号ID
     * @var int
     */
    private $sub_partner_id = 0;
    /**
     * 是否开通直播 0:不开通 1:开通
     * @var int
     */
    private $live_on = 0;
    /**
     * 是否开通点播 0:不开通 1:开通
     * @var int
     */
    private $video_on = 0;
    /**
     * 账号生效日期 格式: 2017-11-24
     * @var string
     */
    private $effect_time = '';
    /**
     * 账号失效日期 格式: 2017-11-24
     * @var string
     */
    private $expire_time = '';
    /**
     * 直播套餐并发值,如开通直播且为并发计费,则该值为必传值
     * @var int
     */
    private $user_limit = 0;
    /**
     * 直播可超额使用到的并发值,如开通直播且为并发计费,则该值为必传值,该值必须不小于user_limit
     * @var int
     */
    private $max_user_limit = 0;
    /**
     * 直播套餐人次/时长点数值,如开通直播且为人次/时长点数计费,则该值为必传值
     * @var int
     */
    private $user_count = 0;
    /**
     * 直播可超额使用到的人次/时长点数值,如开通直播且为人次/时长点数计费,则该值为必传值且不能小于user_count
     * @var int
     */
    private $max_user_count = 0;
    /**
     * 最大上麦路数
     * @var int
     */
    private $live_max_speakers = 0;
    /**
     * 点播存储空间容量,如开通点播播则该值为必传值
     * @var int
     */
    private $storage_limit = 0;
    /**
     * 点播可超额使用到的容量,如开通点播则该值为必传值且必须不小于storage_limit
     * @var int
     */
    private $max_storage_limit = 0;
    /**
     * 点播套餐月流量,如开通点播则该值为必传值
     * @var int
     */
    private $flow_limit = 0;
    /**
     * 点播可超额使用到的月流量,如开通点播则该值为必传值且必须不小于flow_limit
     * @var int
     */
    private $max_flow_limit = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/sub_account/modifySubAccount';
    }

    private function __clone()
    {
    }

    /**
     * @param int $subPartnerId
     * @throws \SyException\Live\BaiJiaException
     */
    public function setSubPartnerId(int $subPartnerId)
    {
        if ($subPartnerId > 0) {
            $this->reqData['sub_partner_id'] = $subPartnerId;
        } else {
            throw new BaiJiaException('子账号ID不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $liveOn
     * @throws \SyException\Live\BaiJiaException
     */
    public function setLiveOn(int $liveOn)
    {
        if (in_array($liveOn, [0, 1])) {
            $this->reqData['live_on'] = $liveOn;
        } else {
            throw new BaiJiaException('开通直播标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $videoOn
     * @throws \SyException\Live\BaiJiaException
     */
    public function setVideoOn(int $videoOn)
    {
        if (in_array($videoOn, [0, 1])) {
            $this->reqData['video_on'] = $videoOn;
        } else {
            throw new BaiJiaException('开通点播标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $effectTime
     * @param int $expireTime
     * @throws \SyException\Live\BaiJiaException
     */
    public function setAccountTime(int $effectTime, int $expireTime)
    {
        $nowTime = Tool::getNowTime();
        if ($effectTime <= 0) {
            throw new BaiJiaException('账号生效时间不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        } elseif ($effectTime >= $expireTime) {
            throw new BaiJiaException('账号生效时间不能大于账号失效时间', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        } elseif ($expireTime <= $nowTime) {
            throw new BaiJiaException('账号失效时间不能小于当前时间', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }

        $this->reqData['effect_time'] = date('Y-m-d', $effectTime);
        $this->reqData['expire_time'] = date('Y-m-d', $expireTime);
    }

    /**
     * @param int $userLimit
     * @param int $maxUserLimit
     * @throws \SyException\Live\BaiJiaException
     */
    public function setUserLimit(int $userLimit, int $maxUserLimit)
    {
        if ($userLimit <= 0) {
            throw new BaiJiaException('直播并发值不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        } elseif ($userLimit > $maxUserLimit) {
            throw new BaiJiaException('直播并发值不能大于直播超额并发值', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }

        $this->reqData['user_limit'] = $userLimit;
        $this->reqData['max_user_limit'] = $maxUserLimit;
    }

    /**
     * @param int $userCount
     * @param int $maxUserCount
     * @throws \SyException\Live\BaiJiaException
     */
    public function setUserCount(int $userCount, int $maxUserCount)
    {
        if ($userCount <= 0) {
            throw new BaiJiaException('直播人次/时长点数值不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        } elseif ($userCount > $maxUserCount) {
            throw new BaiJiaException('直播人次/时长点数值不能大于直播超额人次/时长点数值', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }

        $this->reqData['user_count'] = $userCount;
        $this->reqData['max_user_count'] = $maxUserCount;
    }

    /**
     * @param int $liveMaxSpeakers
     * @throws \SyException\Live\BaiJiaException
     */
    public function setLiveMaxSpeakers(int $liveMaxSpeakers)
    {
        if ($liveMaxSpeakers >= 0) {
            $this->reqData['live_max_speakers'] = $liveMaxSpeakers;
        } else {
            throw new BaiJiaException('最大上麦路数不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $storageLimit
     * @param int $maxStorageLimit
     * @throws \SyException\Live\BaiJiaException
     */
    public function setStorageLimit(int $storageLimit, int $maxStorageLimit)
    {
        if ($storageLimit <= 0) {
            throw new BaiJiaException('点播存储空间容量不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        } elseif ($storageLimit > $maxStorageLimit) {
            throw new BaiJiaException('点播存储空间容量不能大于点播超额存储空间容量', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }

        $this->reqData['storage_limit'] = $storageLimit;
        $this->reqData['max_storage_limit'] = $maxStorageLimit;
    }

    /**
     * @param int $flowLimit
     * @param int $maxFlowLimit
     * @throws \SyException\Live\BaiJiaException
     */
    public function setFlowLimit(int $flowLimit, int $maxFlowLimit)
    {
        if ($flowLimit <= 0) {
            throw new BaiJiaException('点播月流量不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        } elseif ($flowLimit > $maxFlowLimit) {
            throw new BaiJiaException('点播月流量不能大于点播超额月流量', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }

        $this->reqData['flow_limit'] = $flowLimit;
        $this->reqData['max_flow_limit'] = $maxFlowLimit;
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['sub_partner_id'])) {
            throw new BaiJiaException('子账号ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
