<?php
/**
 * 更新房间信息
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
 * Class RoomUpdate
 * @package SyLive\BaiJia\LiveLargeClass\Room
 */
class RoomUpdate extends BaseBaiJia
{
    /**
     * 房间ID
     * @var int
     */
    private $room_id = 0;
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
     * 可选值 教育直播：doubleCamera(双摄像头)、classic(经典模板)、triple(三分屏)
     * @var string
     */
    private $template_name = '';
    /**
     * 指定屏蔽的端 可选值(web:pc浏览器 h5:手机浏览器)多种以英文逗号分隔
     * @var string
     */
    private $forbidden_end_types = '';
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

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/room/update';
    }

    private function __clone()
    {
    }

    /**
     * @param int $roomId
     * @throws \SyException\Live\BaiJiaException
     */
    public function setRoomId(int $roomId)
    {
        if ($roomId > 0) {
            $this->reqData['room_id'] = $roomId;
        } else {
            throw new BaiJiaException('房间ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
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
     * @param string $templateName
     * @throws \SyException\Live\BaiJiaException
     */
    public function setTemplateName(string $templateName)
    {
        if (in_array($templateName, ['doubleCamera', 'classic', 'triple'])) {
            $this->reqData['template_name'] = $templateName;
        } else {
            throw new BaiJiaException('模板名称不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param string $forbiddenEndTypes
     */
    public function setForbiddenEndTypes(string $forbiddenEndTypes)
    {
        $this->reqData['forbidden_end_types'] = trim($forbiddenEndTypes);
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

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BaiJiaException('房间ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
