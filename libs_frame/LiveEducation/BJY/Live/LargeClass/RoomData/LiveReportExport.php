<?php
/**
 * 导出直播教室学员观看记录
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 11:03
 */
namespace LiveEducation\BJY\Live\LargeClass\RoomData;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class LiveReportExport
 * @package LiveEducation\BJY\Live\LargeClass\RoomData
 */
class LiveReportExport extends BaseBJY
{
    /**
     * 房间ID
     * @var int
     */
    private $room_id = 0;
    /**
     * 导出类型 all:所有用户 student:学员 teacher:老师 admin:助教 默认只导出学员观看记录
     * @var string
     */
    private $type = '';
    /**
     * 页数
     * @var int
     */
    private $page = 0;
    /**
     * 每页条数
     * @var int
     */
    private $page_size = 0;
    /**
     * 日期
     * @var string
     */
    private $date = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/room_data/exportLiveReport';
        $this->reqData['type'] = 'student';
        $this->reqData['page'] = 1;
        $this->reqData['page_size'] = 10;
    }

    private function __clone()
    {
    }

    /**
     * @param int $roomId
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setRoomId(int $roomId)
    {
        if ($roomId > 0) {
            $this->reqData['room_id'] = $roomId;
        } else {
            throw new BJYException('房间ID不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param string $type
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setType(string $type)
    {
        if (in_array($type, ['all', 'student', 'teacher', 'admin'])) {
            $this->reqData['type'] = $type;
        } else {
            throw new BJYException('导出类型不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param int $page
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setPage(int $page)
    {
        if ($page > 0) {
            $this->reqData['page'] = $page;
        } else {
            throw new BJYException('页数不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param int $pageSize
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setPageSize(int $pageSize)
    {
        if ($pageSize > 0) {
            $this->reqData['page_size'] = $pageSize;
        } else {
            throw new BJYException('每页条数不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param int $dateTime
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setDate(int $dateTime)
    {
        if ($dateTime > 0) {
            $this->reqData['date'] = date('Y-m-d', $dateTime);
        } else {
            throw new BJYException('日期不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BJYException('房间ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
