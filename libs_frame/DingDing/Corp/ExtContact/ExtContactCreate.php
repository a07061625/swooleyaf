<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-7
 * Time: 下午4:23
 */
namespace DingDing\Corp\ExtContact;

use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyConstant\ErrorCode;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 添加外部联系人
 *
 * @package DingDing\Corp\ExtContact
 */
class ExtContactCreate extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 职位
     *
     * @var string
     */
    private $title = '';
    /**
     * 标签列表
     *
     * @var array
     */
    private $label_ids = [];
    /**
     * 共享部门列表
     *
     * @var array
     */
    private $share_dept_ids = [];
    /**
     * 地址
     *
     * @var string
     */
    private $address = '';
    /**
     * 备注
     *
     * @var string
     */
    private $remark = '';
    /**
     * 负责人用户id
     *
     * @var string
     */
    private $follower_user_id = '';
    /**
     * 名称
     *
     * @var string
     */
    private $name = '';
    /**
     * 手机号国家码
     *
     * @var string
     */
    private $state_code = '';
    /**
     * 企业名
     *
     * @var string
     */
    private $company_name = '';
    /**
     * 共享员工列表
     *
     * @var array
     */
    private $share_user_ids = [];
    /**
     * 手机号
     *
     * @var string
     */
    private $mobile = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['contact'] = [
            'state_code' => '86',
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->reqData['contact']['title'] = trim($title);
    }

    /**
     * @param array $labelIds
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setLabelIds(array $labelIds)
    {
        $labelIdList = [];
        foreach ($labelIds as $eLabelId) {
            if (is_int($eLabelId) && ($eLabelId > 0)) {
                $labelIdList[$eLabelId] = 1;
            }
        }

        if (empty($labelIdList)) {
            throw new TalkException('标签列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['contact']['label_ids'] = array_keys($labelIdList);
    }

    /**
     * @param array $shareDeptIds
     */
    public function setShareDeptIds(array $shareDeptIds)
    {
        $deptIdList = [];
        foreach ($shareDeptIds as $eDeptId) {
            if (is_int($eDeptId) && ($eDeptId > 0)) {
                $deptIdList[$eDeptId] = 1;
            }
        }
        $this->reqData['contact']['share_dept_ids'] = array_keys($deptIdList);
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->reqData['contact']['address'] = trim($address);
    }

    /**
     * @param string $remark
     */
    public function setRemark(string $remark)
    {
        $this->reqData['contact']['remark'] = trim($remark);
    }

    /**
     * @param string $followerUserId
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setFollowerUserId(string $followerUserId)
    {
        if (ctype_alnum($followerUserId)) {
            $this->reqData['contact']['follower_user_id'] = $followerUserId;
        } else {
            throw new TalkException('负责人用户id不合法', ErrorCode::DING_TALK_PARAM_ERROR);
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
            $this->reqData['contact']['name'] = $name;
        } else {
            throw new TalkException('名称不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $companyName
     */
    public function setCompanyName(string $companyName)
    {
        $this->reqData['contact']['company_name'] = trim($companyName);
    }

    /**
     * @param array $shareUserIds
     */
    public function setShareUserIds(array $shareUserIds)
    {
        $users = [];
        foreach ($shareUserIds as $eUserId) {
            if (ctype_alnum($eUserId)) {
                $users[$eUserId] = 1;
            }
        }
        $this->reqData['contact']['share_user_ids'] = array_keys($users);
    }

    /**
     * @param string $mobile
     *
     * @throws \SyException\DingDing\TalkException
     */
    public function setMobile(string $mobile)
    {
        if (ctype_digit($mobile) && (strlen($mobile) == 11) && ($mobile[0] == '1')) {
            $this->reqData['contact']['mobile'] = $mobile;
        } else {
            throw new TalkException('手机号不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['contact']['label_ids'])) {
            throw new TalkException('标签列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['contact']['follower_user_id'])) {
            throw new TalkException('负责人用户id不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['contact']['name'])) {
            throw new TalkException('名称不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['contact']['mobile'])) {
            throw new TalkException('手机号不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/topapi/extcontact/create?' . http_build_query([
            'access_token' => $this->getAccessToken(TalkBaseCorp::ACCESS_TOKEN_TYPE_CORP, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);

        return $this->sendRequest('POST');
    }
}
