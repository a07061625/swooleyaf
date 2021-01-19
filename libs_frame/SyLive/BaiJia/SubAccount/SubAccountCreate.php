<?php
/**
 * 创建子账号
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 13:42
 */

namespace SyLive\BaiJia\SubAccount;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Live\BaiJiaException;
use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyTool\Tool;

/**
 * Class SubAccountCreate
 *
 * @package SyLive\BaiJia\SubAccount
 */
class SubAccountCreate extends BaseBaiJia
{
    /**
     * 手机号
     *
     * @var string
     */
    private $mobile = '';
    /**
     * 邮箱
     *
     * @var string
     */
    private $email = '';
    /**
     * 密码
     *
     * @var string
     */
    private $password = '';
    /**
     * 联系人
     *
     * @var string
     */
    private $contacts = '';
    /**
     * 公司名
     *
     * @var string
     */
    private $company = '';
    /**
     * 是否开通直播 0:不开通 1:开通
     *
     * @var int
     */
    private $live_on = 0;
    /**
     * 是否开通点播 0:不开通 1:开通
     *
     * @var int
     */
    private $video_on = 0;
    /**
     * 账号生效日期 格式: 2017-11-24
     *
     * @var string
     */
    private $effect_time = '';
    /**
     * 账号失效日期 格式: 2017-11-24
     *
     * @var string
     */
    private $expire_time = '';
    /**
     * 直播套餐并发值,如开通直播且为并发计费,则该值为必传值
     *
     * @var int
     */
    private $user_limit = 0;
    /**
     * 直播可超额使用到的并发值,如开通直播且为并发计费,则该值为必传值,该值必须不小于user_limit
     *
     * @var int
     */
    private $max_user_limit = 0;
    /**
     * 直播套餐人次/时长点数值,如开通直播且为人次/时长点数计费,则该值为必传值
     *
     * @var int
     */
    private $user_count = 0;
    /**
     * 直播可超额使用到的人次/时长点数值,如开通直播且为人次/时长点数计费,则该值为必传值且不能小于user_count
     *
     * @var int
     */
    private $max_user_count = 0;
    /**
     * 最大上麦路数
     *
     * @var int
     */
    private $live_max_speakers = 0;
    /**
     * 点播存储空间容量,如开通点播播则该值为必传值
     *
     * @var int
     */
    private $storage_limit = 0;
    /**
     * 点播可超额使用到的容量,如开通点播则该值为必传值且必须不小于storage_limit
     *
     * @var int
     */
    private $max_storage_limit = 0;
    /**
     * 点播套餐月流量,如开通点播则该值为必传值
     *
     * @var int
     */
    private $flow_limit = 0;
    /**
     * 点播可超额使用到的月流量,如开通点播则该值为必传值且必须不小于flow_limit
     *
     * @var int
     */
    private $max_flow_limit = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/sub_account/createSubAccount';
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Live\BaiJiaException
     */
    public function setMobile(string $mobile)
    {
        if (ctype_digit($mobile) && (11 == \strlen($mobile)) && ('1' == $mobile[0])) {
            $this->reqData['mobile'] = $mobile;
        } else {
            throw new BaiJiaException('手机号不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Live\BaiJiaException
     */
    public function setEmail(string $email)
    {
        if (preg_match(ProjectBase::REGEX_EMAIL, $email) > 0) {
            $this->reqData['email'] = $email;
        } else {
            throw new BaiJiaException('邮箱不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Live\BaiJiaException
     */
    public function setPassword(string $password)
    {
        $length = \strlen($password);
        if (($length >= 6) && ($length <= 18)) {
            $this->reqData['password'] = $password;
        } else {
            throw new BaiJiaException('密码不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Live\BaiJiaException
     */
    public function setContacts(string $contacts)
    {
        $trueContacts = trim($contacts);
        if (\strlen($trueContacts) > 0) {
            $this->reqData['contacts'] = $trueContacts;
        } else {
            throw new BaiJiaException('联系人不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Live\BaiJiaException
     */
    public function setCompany(string $company)
    {
        $trueCompany = trim($company);
        if (\strlen($trueCompany) > 0) {
            $this->reqData['company'] = $trueCompany;
        } else {
            throw new BaiJiaException('公司名不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Live\BaiJiaException
     */
    public function setLiveOn(int $liveOn)
    {
        if (\in_array($liveOn, [0, 1])) {
            $this->reqData['live_on'] = $liveOn;
        } else {
            throw new BaiJiaException('开通直播标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Live\BaiJiaException
     */
    public function setVideoOn(int $videoOn)
    {
        if (\in_array($videoOn, [0, 1])) {
            $this->reqData['video_on'] = $videoOn;
        } else {
            throw new BaiJiaException('开通点播标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Live\BaiJiaException
     */
    public function setAccountTime(int $effectTime, int $expireTime)
    {
        $nowTime = Tool::getNowTime();
        if ($effectTime <= 0) {
            throw new BaiJiaException('账号生效时间不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if ($effectTime >= $expireTime) {
            throw new BaiJiaException('账号生效时间不能大于账号失效时间', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if ($expireTime <= $nowTime) {
            throw new BaiJiaException('账号失效时间不能小于当前时间', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }

        $this->reqData['effect_time'] = date('Y-m-d', $effectTime);
        $this->reqData['expire_time'] = date('Y-m-d', $expireTime);
    }

    /**
     * @throws \SyException\Live\BaiJiaException
     */
    public function setUserLimit(int $userLimit, int $maxUserLimit)
    {
        if ($userLimit <= 0) {
            throw new BaiJiaException('直播并发值不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if ($userLimit > $maxUserLimit) {
            throw new BaiJiaException('直播并发值不能大于直播超额并发值', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }

        $this->reqData['user_limit'] = $userLimit;
        $this->reqData['max_user_limit'] = $maxUserLimit;
    }

    /**
     * @throws \SyException\Live\BaiJiaException
     */
    public function setUserCount(int $userCount, int $maxUserCount)
    {
        if ($userCount <= 0) {
            throw new BaiJiaException('直播人次/时长点数值不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if ($userCount > $maxUserCount) {
            throw new BaiJiaException('直播人次/时长点数值不能大于直播超额人次/时长点数值', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }

        $this->reqData['user_count'] = $userCount;
        $this->reqData['max_user_count'] = $maxUserCount;
    }

    /**
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
     * @throws \SyException\Live\BaiJiaException
     */
    public function setStorageLimit(int $storageLimit, int $maxStorageLimit)
    {
        if ($storageLimit <= 0) {
            throw new BaiJiaException('点播存储空间容量不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if ($storageLimit > $maxStorageLimit) {
            throw new BaiJiaException('点播存储空间容量不能大于点播超额存储空间容量', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }

        $this->reqData['storage_limit'] = $storageLimit;
        $this->reqData['max_storage_limit'] = $maxStorageLimit;
    }

    /**
     * @throws \SyException\Live\BaiJiaException
     */
    public function setFlowLimit(int $flowLimit, int $maxFlowLimit)
    {
        if ($flowLimit <= 0) {
            throw new BaiJiaException('点播月流量不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if ($flowLimit > $maxFlowLimit) {
            throw new BaiJiaException('点播月流量不能大于点播超额月流量', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }

        $this->reqData['flow_limit'] = $flowLimit;
        $this->reqData['max_flow_limit'] = $maxFlowLimit;
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['mobile'])) {
            throw new BaiJiaException('手机号不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (!isset($this->reqData['email'])) {
            throw new BaiJiaException('邮箱不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (!isset($this->reqData['password'])) {
            throw new BaiJiaException('密码不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (!isset($this->reqData['contacts'])) {
            throw new BaiJiaException('联系人不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (!isset($this->reqData['company'])) {
            throw new BaiJiaException('公司名不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (!isset($this->reqData['live_on'])) {
            throw new BaiJiaException('开通直播标识不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (!isset($this->reqData['video_on'])) {
            throw new BaiJiaException('开通点播标识不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (!isset($this->reqData['effect_time'])) {
            throw new BaiJiaException('账号生效日期不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
