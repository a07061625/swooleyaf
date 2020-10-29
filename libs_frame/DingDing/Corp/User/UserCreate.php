<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-28
 * Time: 上午11:15
 */
namespace DingDing\Corp\User;

use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyConstant\ErrorCode;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 创建用户
 *
 * @package DingDing\Corp\User
 */
class UserCreate extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 用户id
     *
     * @var string
     */
    private $userid = '';
    /**
     * 名称
     *
     * @var string
     */
    private $name = '';
    /**
     * 部门排序
     *
     * @var string
     */
    private $orderInDepts = '';
    /**
     * 部门列表
     *
     * @var array
     */
    private $department = [];
    /**
     * 职位信息
     *
     * @var string
     */
    private $position = '';
    /**
     * 手机号码
     *
     * @var string
     */
    private $mobile = '';
    /**
     * 分机号
     *
     * @var string
     */
    private $tel = '';
    /**
     * 办公地点
     *
     * @var string
     */
    private $workPlace = '';
    /**
     * 备注
     *
     * @var string
     */
    private $remark = '';
    /**
     * 邮箱
     *
     * @var string
     */
    private $email = '';
    /**
     * 企业邮箱
     *
     * @var string
     */
    private $orgEmail = '';
    /**
     * 工号
     *
     * @var string
     */
    private $jobnumber = '';
    /**
     * 号码隐藏标识
     *
     * @var bool
     */
    private $isHide = false;
    /**
     * 高管模式
     *
     * @var bool
     */
    private $isSenior = false;
    /**
     * 扩展属性
     *
     * @var array
     */
    private $extattr = [];

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['userid'] = Tool::createNonceStr(8, 'numlower') . Tool::getNowTime();
        $this->reqData['department'] = [];
        $this->reqData['isHide'] = false;
        $this->reqData['isSenior'] = false;
    }

    private function __clone()
    {
    }

    /**
     * @param string $userId
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setUserId(string $userId)
    {
        if (ctype_alnum($userId) && (strlen($userId) <= 64)) {
            $this->reqData['userid'] = $userId;
        } else {
            throw new TalkException('用户id不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $name
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setName(string $name)
    {
        if (strlen($name) > 0) {
            $this->reqData['name'] = mb_substr($name, 0, 32);
        } else {
            throw new TalkException('名称不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param array $departmentOrder
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setDepartmentOrder(array $departmentOrder)
    {
        if (empty($departmentOrder)) {
            throw new TalkException('部门排序不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['orderInDepts'] = Tool::jsonEncode($departmentOrder, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param array $departmentList
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setDepartment(array $departmentList)
    {
        $departments = [];
        foreach ($departmentList as $eDepartmentId) {
            if (is_int($eDepartmentId) && ($eDepartmentId > 0)) {
                $departments[$eDepartmentId] = 1;
            }
        }
        if (empty($departments)) {
            throw new TalkException('部门列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['department'] = array_keys($departments);
    }

    /**
     * @param string $position
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setPosition(string $position)
    {
        if (strlen($position) > 0) {
            $this->reqData['position'] = mb_substr($position, 0, 32);
        } else {
            throw new TalkException('职位信息不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $mobile
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setMobile(string $mobile)
    {
        if (ctype_digit($mobile) && (strlen($mobile) == 11) && ($mobile[0] == '1')) {
            $this->reqData['mobile'] = $mobile;
        } else {
            throw new TalkException('手机号码不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $tel
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setTel(string $tel)
    {
        if (strlen($tel) > 0) {
            $this->reqData['tel'] = substr($tel, 0, 50);
        } else {
            throw new TalkException('分机号不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $workPlace
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setWorkPlace(string $workPlace)
    {
        if (strlen($workPlace) > 0) {
            $this->reqData['workPlace'] = mb_substr($workPlace, 0, 25);
        } else {
            throw new TalkException('办公地点不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $remark
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setRemark(string $remark)
    {
        if (strlen($remark) > 0) {
            $this->reqData['remark'] = mb_substr($remark, 0, 500);
        } else {
            throw new TalkException('备注不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $email
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setEmail(string $email)
    {
        if (strlen($email) > 0) {
            $this->reqData['email'] = substr($email, 0, 64);
        } else {
            throw new TalkException('邮箱不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $orgEmail
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setOrgEmail(string $orgEmail)
    {
        if (strlen($orgEmail) > 0) {
            $this->reqData['orgEmail'] = $orgEmail;
        } else {
            throw new TalkException('企业邮箱不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $jobNumber
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setJobNumber(string $jobNumber)
    {
        if (strlen($jobNumber) > 0) {
            $this->reqData['jobnumber'] = substr($jobNumber, 0, 64);
        } else {
            throw new TalkException('工号不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param bool $isHide
     */
    public function setIsHide(bool $isHide)
    {
        $this->reqData['isHide'] = $isHide;
    }

    /**
     * @param bool $isSenior
     */
    public function setIsSenior(bool $isSenior)
    {
        $this->reqData['isSenior'] = $isSenior;
    }

    /**
     * @param array $extAttr
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setExtAttr(array $extAttr)
    {
        if (empty($extAttr)) {
            throw new TalkException('扩展属性不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['extattr'] = $extAttr;
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['name'])) {
            throw new TalkException('名称不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (empty($this->reqData['department'])) {
            throw new TalkException('部门列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['mobile'])) {
            throw new TalkException('手机号码不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['jobnumber'])) {
            throw new TalkException('工号不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/user/create?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);

        return $this->sendRequest('POST');
    }
}
