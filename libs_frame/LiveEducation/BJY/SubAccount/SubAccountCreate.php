<?php
/**
 * 创建子账号
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 13:42
 */
namespace LiveEducation\BJY\SubAccount;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;
use SyTool\Tool;

/**
 * Class SubAccountCreate
 * @package LiveEducation\BJY\SubAccount
 */
class SubAccountCreate extends BaseBJY
{
    /**
     * 手机号
     * @var string
     */
    private $mobile = '';
    /**
     * 邮箱
     * @var string
     */
    private $email = '';
    /**
     * 密码
     * @var string
     */
    private $password = '';
    /**
     * 联系人
     * @var string
     */
    private $contacts = '';
    /**
     * 公司名
     * @var string
     */
    private $company = '';
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
        $this->serviceUri = '/openapi/sub_account/createSubAccount';
    }

    private function __clone()
    {
    }

    /**
     * @param string $mobile
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setMobile(string $mobile)
    {
        if (ctype_digit($mobile) && (strlen($mobile) == 11) && ($mobile{0} == '1')) {
            $this->reqData['mobile'] = $mobile;
        } else {
            throw new BJYException('手机号不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param string $email
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setEmail(string $email)
    {
        if (preg_match('/^\w+([-+.]\w+)*\@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $email) > 0) {
            $this->reqData['email'] = $email;
        } else {
            throw new BJYException('邮箱不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param string $password
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setPassword(string $password)
    {
        $length = strlen($password);
        if (($length >= 6) && ($length <= 18)) {
            $this->reqData['password'] = $password;
        } else {
            throw new BJYException('密码不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param string $contacts
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setContacts(string $contacts)
    {
        $trueContacts = trim($contacts);
        if (strlen($trueContacts) > 0) {
            $this->reqData['contacts'] = $trueContacts;
        } else {
            throw new BJYException('联系人不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param string $company
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setCompany(string $company)
    {
        $trueCompany = trim($company);
        if (strlen($trueCompany) > 0) {
            $this->reqData['company'] = $trueCompany;
        } else {
            throw new BJYException('公司名不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param int $liveOn
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setLiveOn(int $liveOn)
    {
        if (in_array($liveOn, [0, 1])) {
            $this->reqData['live_on'] = $liveOn;
        } else {
            throw new BJYException('开通直播标识不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param int $videoOn
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setVideoOn(int $videoOn)
    {
        if (in_array($videoOn, [0, 1])) {
            $this->reqData['video_on'] = $videoOn;
        } else {
            throw new BJYException('开通点播标识不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param int $effectTime
     * @param int $expireTime
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setAccountTime(int $effectTime, int $expireTime)
    {
        $nowTime = Tool::getNowTime();
        if ($effectTime <= 0) {
            throw new BJYException('账号生效时间不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        } elseif ($effectTime >= $expireTime) {
            throw new BJYException('账号生效时间不能大于账号失效时间', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        } elseif ($expireTime <= $nowTime) {
            throw new BJYException('账号失效时间不能小于当前时间', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }

        $this->reqData['effect_time'] = date('Y-m-d', $effectTime);
        $this->reqData['expire_time'] = date('Y-m-d', $expireTime);
    }

    /**
     * @param int $userLimit
     * @param int $maxUserLimit
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setUserLimit(int $userLimit, int $maxUserLimit)
    {
        if ($userLimit <= 0) {
            throw new BJYException('直播并发值不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        } elseif ($userLimit > $maxUserLimit) {
            throw new BJYException('直播并发值不能大于直播超额并发值', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }

        $this->reqData['user_limit'] = $userLimit;
        $this->reqData['max_user_limit'] = $maxUserLimit;
    }

    /**
     * @param int $userCount
     * @param int $maxUserCount
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setUserCount(int $userCount, int $maxUserCount)
    {
        if ($userCount <= 0) {
            throw new BJYException('直播人次/时长点数值不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        } elseif ($userCount > $maxUserCount) {
            throw new BJYException('直播人次/时长点数值不能大于直播超额人次/时长点数值', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }

        $this->reqData['user_count'] = $userCount;
        $this->reqData['max_user_count'] = $maxUserCount;
    }

    /**
     * @param int $liveMaxSpeakers
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setLiveMaxSpeakers(int $liveMaxSpeakers)
    {
        if ($liveMaxSpeakers >= 0) {
            $this->reqData['live_max_speakers'] = $liveMaxSpeakers;
        } else {
            throw new BJYException('最大上麦路数不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param int $storageLimit
     * @param int $maxStorageLimit
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setStorageLimit(int $storageLimit, int $maxStorageLimit)
    {
        if ($storageLimit <= 0) {
            throw new BJYException('点播存储空间容量不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        } elseif ($storageLimit > $maxStorageLimit) {
            throw new BJYException('点播存储空间容量不能大于点播超额存储空间容量', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }

        $this->reqData['storage_limit'] = $storageLimit;
        $this->reqData['max_storage_limit'] = $maxStorageLimit;
    }

    /**
     * @param int $flowLimit
     * @param int $maxFlowLimit
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setFlowLimit(int $flowLimit, int $maxFlowLimit)
    {
        if ($flowLimit <= 0) {
            throw new BJYException('点播月流量不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        } elseif ($flowLimit > $maxFlowLimit) {
            throw new BJYException('点播月流量不能大于点播超额月流量', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }

        $this->reqData['flow_limit'] = $flowLimit;
        $this->reqData['max_flow_limit'] = $maxFlowLimit;
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['mobile'])) {
            throw new BJYException('手机号不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (!isset($this->reqData['email'])) {
            throw new BJYException('邮箱不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (!isset($this->reqData['password'])) {
            throw new BJYException('密码不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (!isset($this->reqData['contacts'])) {
            throw new BJYException('联系人不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (!isset($this->reqData['company'])) {
            throw new BJYException('公司名不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (!isset($this->reqData['live_on'])) {
            throw new BJYException('开通直播标识不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (!isset($this->reqData['video_on'])) {
            throw new BJYException('开通点播标识不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (!isset($this->reqData['effect_time'])) {
            throw new BJYException('账号生效日期不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
