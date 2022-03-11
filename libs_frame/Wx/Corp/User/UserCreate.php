<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/22 0022
 * Time: 11:05
 */

namespace Wx\Corp\User;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 创建成员
 *
 * @package Wx\Corp\User
 */
class UserCreate extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 用户ID
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
     * 别名
     *
     * @var string
     */
    private $alias = '';
    /**
     * 手机号码
     *
     * @var string
     */
    private $mobile = '';
    /**
     * 部门id列表
     *
     * @var array
     */
    private $department = [];
    /**
     * 排序值,默认为0,数量必须和department一致,数值越大排序越前面
     *
     * @var array
     */
    private $order = [];
    /**
     * 职务信息
     *
     * @var string
     */
    private $position = '';
    /**
     * 性别 1:男性 2:女性
     *
     * @var int
     */
    private $gender = 0;
    /**
     * 邮箱
     *
     * @var string
     */
    private $email = '';
    /**
     * 座机
     *
     * @var string
     */
    private $telephone = '';
    /**
     * 上级标识,个数必须和department一致 1:上级 0:非上级
     *
     * @var array
     */
    private $is_leader_in_dept = [];
    /**
     * 头像
     *
     * @var string
     */
    private $avatar_mediaid = '';
    /**
     * 成员标识 1:启用 0:禁用
     *
     * @var int
     */
    private $enable = 0;
    /**
     * 扩展属性
     *
     * @var array
     */
    private $extattr = [];
    /**
     * 邀请标识,默认值为true true:邀请使用企业微信 false:不邀请
     *
     * @var bool
     */
    private $to_invite = true;
    /**
     * 对外属性
     *
     * @var array
     */
    private $external_profile = [];
    /**
     * 对外职务
     *
     * @var string
     */
    private $external_position = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/user/create?access_token=';
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['userid'] = Tool::createNonceStr('8', 'numlower') . Tool::getNowTime();
        $this->reqData['gender'] = 1;
        $this->reqData['enable'] = 1;
        $this->reqData['to_invite'] = true;
        $this->reqData['department'] = [];
        $this->reqData['order'] = [];
        $this->reqData['is_leader_in_dept'] = [];
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setUserId(string $userId)
    {
        if (ctype_alnum($userId) && (\strlen($userId) <= 32)) {
            $this->reqData['userid'] = strtolower($userId);
        } else {
            throw new WxException('用户ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setName(string $name)
    {
        if (\strlen($name) > 0) {
            $this->reqData['name'] = mb_substr($name, 0, 32);
        } else {
            throw new WxException('名称不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setAlias(string $alias)
    {
        if (\strlen($alias) > 0) {
            $this->reqData['alias'] = mb_substr($alias, 0, 16);
        } else {
            throw new WxException('别名不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setMobile(string $mobile)
    {
        if (ctype_digit($mobile) && (11 == \strlen($mobile)) && ('1' == $mobile[0])) {
            $this->reqData['mobile'] = $mobile;
        } else {
            throw new WxException('手机号码不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function addDepartmentInfo(array $departmentInfo)
    {
        if (\count($this->reqData['department']) >= 20) {
            throw new WxException('部门id列表不能超过20个', ErrorCode::WX_PARAM_ERROR);
        }

        $departmentId = Tool::getArrayVal($departmentInfo, 'depart_id', 0);
        if (!\is_int($departmentId)) {
            throw new WxException('部门id必须是整数', ErrorCode::WX_PARAM_ERROR);
        }
        if ($departmentId <= 0) {
            throw new WxException('部门id必须大于0', ErrorCode::WX_PARAM_ERROR);
        }

        $orderNum = Tool::getArrayVal($departmentInfo, 'order_num', -1);
        if (!\is_int($orderNum)) {
            throw new WxException('排序值必须是整数', ErrorCode::WX_PARAM_ERROR);
        }
        if ($orderNum < 0) {
            throw new WxException('排序值必须大于等于0', ErrorCode::WX_PARAM_ERROR);
        }

        $leaderFlag = Tool::getArrayVal($departmentInfo, 'leader_flag', -1);
        if (!\is_int($leaderFlag)) {
            throw new WxException('上级标识必须是整数', ErrorCode::WX_PARAM_ERROR);
        }
        if (!\in_array($leaderFlag, [0, 1], true)) {
            throw new WxException('上级标识不合法', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['department'][] = $departmentId;
        $this->reqData['order'][] = $orderNum;
        $this->reqData['is_leader_in_dept'][] = $leaderFlag;
    }

    public function setPosition(string $position)
    {
        $this->reqData['position'] = mb_substr($position, 0, 64);
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setGender(int $gender)
    {
        if (\in_array($gender, [1, 2], true)) {
            $this->reqData['gender'] = $gender;
        } else {
            throw new WxException('性别不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setEmail(string $email)
    {
        if (\strlen($email) > 0) {
            $this->reqData['email'] = $email;
        } else {
            throw new WxException('邮箱不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setTelephone(string $telephone)
    {
        $trueTelephone = preg_replace('/[^0-9\-]+/', '', $telephone);
        if (\strlen($trueTelephone) > 0) {
            $this->reqData['telephone'] = $trueTelephone;
        } else {
            throw new WxException('座机不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setAvatarMediaId(string $avatarMediaId)
    {
        if (\strlen($avatarMediaId) > 0) {
            $this->reqData['avatar_mediaid'] = $avatarMediaId;
        } else {
            throw new WxException('头像不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setEnable(int $enable)
    {
        if (\in_array($enable, [0, 1], true)) {
            $this->reqData['enable'] = $enable;
        } else {
            throw new WxException('成员标识不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setExtAttr(array $extAttr)
    {
        if (empty($extAttr)) {
            throw new WxException('扩展属性不合法', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['extattr'] = $extAttr;
    }

    public function setInviteFlag(bool $inviteFlag)
    {
        $this->reqData['to_invite'] = $inviteFlag;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setExternalProfile(array $externalProfile)
    {
        if (empty($externalProfile)) {
            throw new WxException('对外属性不合法', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['external_profile'] = $externalProfile;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setExternalPosition(string $externalPosition)
    {
        if (\strlen($externalPosition) > 0) {
            $this->reqData['external_position'] = mb_substr($externalPosition, 0, 12);
        } else {
            throw new WxException('对外职务不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (empty($this->reqData['department'])) {
            throw new WxException('部门id列表不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['name'])) {
            throw new WxException('名称不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if ((!isset($this->reqData['mobile'])) && !isset($this->reqData['email'])) {
            throw new WxException('手机号码和邮箱不能同时为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (0 == $sendData['errcode']) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
