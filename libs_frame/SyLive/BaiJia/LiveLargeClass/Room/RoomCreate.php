<?php
/**
 * 创建房间
 * User: 姜伟
 * Date: 2020/3/29 0029
 * Time: 21:49
 */
namespace SyLive\BaiJia\LiveLargeClass\Room;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;
use SyTool\Tool;

/**
 * Class RoomCreate
 * @package SyLive\BaiJia\LiveLargeClass\Room
 */
class RoomCreate extends BaseBaiJia
{
    /**
     * 直播课标题,不超过50个字符或汉字
     * @var string
     */
    private $title = '';
    /**
     * 开课时间
     * @var int
     */
    private $start_time = 0;
    /**
     * 下课时间
     * @var int
     */
    private $end_time = 0;
    /**
     * 类型 1:一对一课（老的班型，老账号支持） 2:普通大班课 3:小班课普通版（老的班型，老账号支持）
     * @var int
     */
    private $type = 0;
    /**
     * 0:表示教育
     * @var int
     */
    private $industry_type = 0;
    /**
     * 普通大班课最大人数,不传或传0表示不限制
     * @var int
     */
    private $max_users = 0;
    /**
     * 学生可提前进入的时间,单位为秒
     * @var int
     */
    private $pre_enter_time = 0;
    /**
     * 是否是长期房间 0:普通房间(注:普通房间时长小于24小时) 1:长期房间 默认为普通房间(注:需要给账号开通长期房间权限才可以创建长期房间)
     * @var int
     */
    private $is_long_term = 0;
    /**
     * 是否是分组直播 0:常规直播 1:分组直播(注:需要给账号开通分组直播权限才可以创建分组直播,必须同时指定参数type为2)2:分组直播-大小班(注:需要权限,参数type须为2)
     * @var int
     */
    private $is_group_live = 0;
    /**
     * 可选值 教育直播：doubleCamera(双摄像头)、classic(经典模板)、triple(三分屏)、single(单视频模板)、liveWall(视频墙) 默认triple
     * @var string
     */
    private $template_name = '';
    /**
     * 学生发言时是否自动开启摄像头 1:开启 2:不开启 默认会开启
     * @var int
     */
    private $speak_camera_turnon = 0;
    /**
     * 老师是否启用设备检测 1:启用 2:不启用 默认不启用
     * @var int
     */
    private $teacher_need_detect_device = 0;
    /**
     * 学生是否启用设备检测 1:启用 2:不启用 默认不启用
     * @var int
     */
    private $student_need_detect_device = 0;
    /**
     * 指定PC端是否以视频为主 1:以视频为主 2:以PPT为主 (默认是以ppt为主，该选项只针对三分屏有效)
     * @var int
     */
    private $is_video_main = 0;
    /**
     * 指定手机H5页面是否以视频为主 1:以视频为主 2:以PPT为主 (默认是以视频为主)
     * @var int
     */
    private $m_is_video_main = 0;
    /**
     * 是否是伪直播 0:否 1:是(注：需要给账号开通伪直播权限才可以创建伪直播,选择伪直播时,必须要选择mock_video_id或mock_room_id和mock_session_id)
     * @var int
     */
    private $is_mock_live = 0;
    /**
     * 是否是推流直播，0:常规直播 1:推流直播 默认是常规直播(注：需要给账号开通推流直播的权限)
     * @var int
     */
    private $is_push_live = 0;
    /**
     * 是否是webrtc课程,1:是(需要联系百家云配置webrtc类型才可使用)
     * @var int
     */
    private $is_webrtc_live = 0;
    /**
     * 伪直播关联的回放教室号
     * @var int
     */
    private $mock_room_id = 0;
    /**
     * 伪直播关联的回放教室session_id(针对长期房间)
     * @var int
     */
    private $mock_session_id = 0;
    /**
     * 伪直播关联的点播视频ID
     * @var int
     */
    private $mock_video_id = 0;
    /**
     * 分组直播,大小班切换控制角色 1：大班老师控制 2 小班老师控制
     * @var int
     */
    private $switch_room_role = 0;
    /**
     * 是否允许APP分享 1:允许 2:不允许 0或不传则使用默认值,默认是允许
     * @var int
     */
    private $enable_share = 0;
    /**
     * 分组课堂/线上双师 成员名单数据权限 0:成员只看组内权限 1:成员可看全部权限 0或不传则使用默认值,默认是成员只看组内权限
     * @var int
     */
    private $enable_group_users_public = 0;
    /**
     * 分组/线上双师 助教查看答题数据权限 0:助教查看组内答题数据 1:助教查看全部数据 0或不传则使用默认值,默认是助教查看组内答题数据
     * @var int
     */
    private $group_admin_permission = 0;
    /**
     * 分组直播/线上双师 成员聊天数据权限 0:成员只看组内权限 1:成员可看全部权限 0或不传则使用默认值,默认是成员只看组内权限
     * @var int
     */
    private $enable_group_chat_public = 0;
    /**
     * 是否分组 0:常规直播 1:分组课堂(注:需要给账号开通相关权限才可以创建分组直播,必须同时指定参数type为2)2:线上双师(注:需要权限,参数type须为2)
     * @var int
     */
    private $new_group_live = 0;
    /**
     * 伪直播自动录制 1:是 0:否
     * @var int
     */
    private $mock_live_record = 0;
    /**
     * 是否启用微信授权 1:启用 2:不启用
     * @var int
     */
    private $enable_weixin_auth = 0;
    /**
     * 有无学生上麦,仅在webrtc班型上使用此参数 0:无 1:有
     * @var int
     */
    private $has_student_raise = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/room/create';
        $this->reqData['type'] = 2;
        $this->reqData['industry_type'] = 0;
        $this->reqData['max_users'] = 0;
        $this->reqData['pre_enter_time'] = 0;
        $this->reqData['is_long_term'] = 0;
        $this->reqData['is_group_live'] = 0;
        $this->reqData['template_name'] = 'triple';
        $this->reqData['speak_camera_turnon'] = 1;
        $this->reqData['teacher_need_detect_device'] = 2;
        $this->reqData['student_need_detect_device'] = 2;
        $this->reqData['is_video_main'] = 2;
        $this->reqData['m_is_video_main'] = 1;
        $this->reqData['is_mock_live'] = 0;
        $this->reqData['is_push_live'] = 0;
        $this->reqData['is_webrtc_live'] = 0;
        $this->reqData['mock_room_id'] = 0;
        $this->reqData['mock_session_id'] = 0;
        $this->reqData['mock_video_id'] = 0;
        $this->reqData['switch_room_role'] = 1;
        $this->reqData['enable_share'] = 1;
        $this->reqData['enable_group_users_public'] = 0;
        $this->reqData['group_admin_permission'] = 0;
        $this->reqData['enable_group_chat_public'] = 0;
        $this->reqData['new_group_live'] = 0;
        $this->reqData['mock_live_record'] = 1;
        $this->reqData['enable_weixin_auth'] = 1;
        $this->reqData['has_student_raise'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @param string $title
     * @throws \SyException\Live\BaiJiaException
     */
    public function setTitle(string $title)
    {
        $trueTitle = trim($title);
        if (strlen($trueTitle) > 0) {
            $this->reqData['title'] = mb_substr($trueTitle, 0, 50);
        } else {
            throw new BaiJiaException('直播课标题不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $startTime
     * @param int $endTime
     * @throws \SyException\Live\BaiJiaException
     */
    public function setTime(int $startTime, int $endTime)
    {
        $nowTime = Tool::getNowTime();
        if ($startTime >= $endTime) {
            throw new BaiJiaException('开始时间必须小于结束时间', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        } elseif ($endTime <= $nowTime) {
            throw new BaiJiaException('结束时间不能小于当前时间', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if ($this->reqData['is_long_term'] == 0) {
            if (($endTime - $startTime) <= 900) {
                throw new BaiJiaException('结束时间必须超过开始时间15分钟', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
            } elseif (($endTime - $startTime) >= 86400) {
                throw new BaiJiaException('结束时间不能超过开始时间24小时', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
            }
        }

        $this->reqData['start_time'] = $startTime;
        $this->reqData['end_time'] = $endTime;
    }

    /**
     * @param int $type
     * @throws \SyException\Live\BaiJiaException
     */
    public function setType(int $type)
    {
        if (in_array($type, [1, 2, 3])) {
            $this->reqData['type'] = $type;
        } else {
            throw new BaiJiaException('课程类型不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $maxUsers
     * @throws \SyException\Live\BaiJiaException
     */
    public function setMaxUsers(int $maxUsers)
    {
        if ($maxUsers >= 0) {
            $this->reqData['max_users'] = $maxUsers;
        } else {
            throw new BaiJiaException('普通大班课最大人数不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $preEnterTime
     * @throws \SyException\Live\BaiJiaException
     */
    public function setPreEnterTime(int $preEnterTime)
    {
        if ($preEnterTime >= 0) {
            $this->reqData['pre_enter_time'] = $preEnterTime;
        } else {
            throw new BaiJiaException('学生可提前进入的时间不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $isLongTerm
     * @throws \SyException\Live\BaiJiaException
     */
    public function setIsLongTerm(int $isLongTerm)
    {
        if (in_array($isLongTerm, [0, 1])) {
            $this->reqData['is_long_term'] = $isLongTerm;
        } else {
            throw new BaiJiaException('长期房间标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $isGroupLive
     * @throws \SyException\Live\BaiJiaException
     */
    public function setIsGroupLive(int $isGroupLive)
    {
        if (in_array($isGroupLive, [0, 1, 2])) {
            $this->reqData['is_group_live'] = $isGroupLive;
        } else {
            throw new BaiJiaException('分组直播标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param string $templateName
     * @throws \SyException\Live\BaiJiaException
     */
    public function setTemplateName(string $templateName)
    {
        if (in_array($templateName, ['doubleCamera', 'classic', 'triple', 'single', 'liveWall'])) {
            $this->reqData['template_name'] = $templateName;
        } else {
            throw new BaiJiaException('模板名称不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $speakCameraTurnon
     * @throws \SyException\Live\BaiJiaException
     */
    public function setSpeakCameraTurnon(int $speakCameraTurnon)
    {
        if (in_array($speakCameraTurnon, [1, 2])) {
            $this->reqData['speak_camera_turnon'] = $speakCameraTurnon;
        } else {
            throw new BaiJiaException('学生发言自动开启摄像头标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $teacherNeedDetectDevice
     * @throws \SyException\Live\BaiJiaException
     */
    public function setTeacherNeedDetectDevice(int $teacherNeedDetectDevice)
    {
        if (in_array($teacherNeedDetectDevice, [1, 2])) {
            $this->reqData['teacher_need_detect_device'] = $teacherNeedDetectDevice;
        } else {
            throw new BaiJiaException('老师启用设备检测标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $studentNeedDetectDevice
     * @throws \SyException\Live\BaiJiaException
     */
    public function setStudentNeedDetectDevice(int $studentNeedDetectDevice)
    {
        if (in_array($studentNeedDetectDevice, [1, 2])) {
            $this->reqData['student_need_detect_device'] = $studentNeedDetectDevice;
        } else {
            throw new BaiJiaException('学生启用设备检测标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $isVideoMain
     * @throws \SyException\Live\BaiJiaException
     */
    public function setIsVideoMain(int $isVideoMain)
    {
        if (in_array($isVideoMain, [1, 2])) {
            $this->reqData['is_video_main'] = $isVideoMain;
        } else {
            throw new BaiJiaException('PC端视频标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $mIsVideoMain
     * @throws \SyException\Live\BaiJiaException
     */
    public function setMIsVideoMain(int $mIsVideoMain)
    {
        if (in_array($mIsVideoMain, [1, 2])) {
            $this->reqData['m_is_video_main'] = $mIsVideoMain;
        } else {
            throw new BaiJiaException('手机H5页面视频标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $isMockLive
     * @throws \SyException\Live\BaiJiaException
     */
    public function setIsMockLive(int $isMockLive)
    {
        if (in_array($isMockLive, [0, 1])) {
            $this->reqData['is_mock_live'] = $isMockLive;
        } else {
            throw new BaiJiaException('伪直播标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $isPushLive
     * @throws \SyException\Live\BaiJiaException
     */
    public function setIsPushLive(int $isPushLive)
    {
        if (in_array($isPushLive, [0, 1])) {
            $this->reqData['is_push_live'] = $isPushLive;
        } else {
            throw new BaiJiaException('推流直播标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $isWebrtcLive
     * @throws \SyException\Live\BaiJiaException
     */
    public function setIsWebrtcLive(int $isWebrtcLive)
    {
        if (in_array($isWebrtcLive, [0, 1])) {
            $this->reqData['is_webrtc_live'] = $isWebrtcLive;
        } else {
            throw new BaiJiaException('webrtc课程标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $mockRoomId
     * @throws \SyException\Live\BaiJiaException
     */
    public function setMockRoomId(int $mockRoomId)
    {
        if ($mockRoomId >= 0) {
            $this->reqData['mock_room_id'] = $mockRoomId;
        } else {
            throw new BaiJiaException('伪直播回放教室号不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $mockSessionId
     * @throws \SyException\Live\BaiJiaException
     */
    public function setMockSessionId(int $mockSessionId)
    {
        if ($mockSessionId >= 0) {
            $this->reqData['mock_session_id'] = $mockSessionId;
        } else {
            throw new BaiJiaException('伪直播回放教室session_id不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $mockVideoId
     * @throws \SyException\Live\BaiJiaException
     */
    public function setMockVideoId(int $mockVideoId)
    {
        if ($mockVideoId >= 0) {
            $this->reqData['mock_video_id'] = $mockVideoId;
        } else {
            throw new BaiJiaException('伪直播点播视频ID不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $switchRoomRole
     * @throws \SyException\Live\BaiJiaException
     */
    public function setSwitchRoomRole(int $switchRoomRole)
    {
        if (in_array($switchRoomRole, [1, 2])) {
            $this->reqData['switch_room_role'] = $switchRoomRole;
        } else {
            throw new BaiJiaException('大小班切换控制角色标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $enableShare
     * @throws \SyException\Live\BaiJiaException
     */
    public function setEnableShare(int $enableShare)
    {
        if (in_array($enableShare, [1, 2])) {
            $this->reqData['enable_share'] = $enableShare;
        } else {
            throw new BaiJiaException('APP分享标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $enableGroupUsersPublic
     * @throws \SyException\Live\BaiJiaException
     */
    public function setEnableGroupUsersPublic(int $enableGroupUsersPublic)
    {
        if (in_array($enableGroupUsersPublic, [0, 1])) {
            $this->reqData['enable_group_users_public'] = $enableGroupUsersPublic;
        } else {
            throw new BaiJiaException('成员名单数据权限标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $groupAdminPermission
     * @throws \SyException\Live\BaiJiaException
     */
    public function setGroupAdminPermission(int $groupAdminPermission)
    {
        if (in_array($groupAdminPermission, [0, 1])) {
            $this->reqData['group_admin_permission'] = $groupAdminPermission;
        } else {
            throw new BaiJiaException('助教查看答题数据权限标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $enableGroupChatPublic
     * @throws \SyException\Live\BaiJiaException
     */
    public function setEnableGroupChatPublic(int $enableGroupChatPublic)
    {
        if (in_array($enableGroupChatPublic, [0, 1])) {
            $this->reqData['enable_group_chat_public'] = $enableGroupChatPublic;
        } else {
            throw new BaiJiaException('成员聊天数据权限标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $newGroupLive
     * @throws \SyException\Live\BaiJiaException
     */
    public function setNewGroupLive(int $newGroupLive)
    {
        if (in_array($newGroupLive, [0, 1, 2])) {
            $this->reqData['new_group_live'] = $newGroupLive;
        } else {
            throw new BaiJiaException('分组标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $mockLiveRecord
     * @throws \SyException\Live\BaiJiaException
     */
    public function setMockLiveRecord(int $mockLiveRecord)
    {
        if (in_array($mockLiveRecord, [0, 1])) {
            $this->reqData['mock_live_record'] = $mockLiveRecord;
        } else {
            throw new BaiJiaException('伪直播自动录制标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $enableWeixinAuth
     * @throws \SyException\Live\BaiJiaException
     */
    public function setEnableWeixinAuth(int $enableWeixinAuth)
    {
        if (in_array($enableWeixinAuth, [1, 2])) {
            $this->reqData['enable_weixin_auth'] = $enableWeixinAuth;
        } else {
            throw new BaiJiaException('微信授权标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $hasStudentRaise
     * @throws \SyException\Live\BaiJiaException
     */
    public function setHasStudentRaise(int $hasStudentRaise)
    {
        if (in_array($hasStudentRaise, [0, 1])) {
            $this->reqData['has_student_raise'] = $hasStudentRaise;
        } else {
            throw new BaiJiaException('学生上麦标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['title'])) {
            throw new BaiJiaException('直播课标题不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (!isset($this->reqData['start_time'])) {
            throw new BaiJiaException('开始时间不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
