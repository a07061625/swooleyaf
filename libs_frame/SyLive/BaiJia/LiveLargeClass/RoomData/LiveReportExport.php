<?php
/**
 * 导出直播教室学员观看记录
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 11:03
 */
namespace SyLive\BaiJia\LiveLargeClass\RoomData;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class LiveReportExport
 * @package SyLive\BaiJia\LiveLargeClass\RoomData
 */
class LiveReportExport extends BaseBaiJia
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
     * @throws \SyException\Live\BaiJiaException
     */
    public function setRoomId(int $roomId)
    {
        if ($roomId > 0) {
            $this->reqData['room_id'] = $roomId;
        } else {
            throw new BaiJiaException('房间ID不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param string $type
     * @throws \SyException\Live\BaiJiaException
     */
    public function setType(string $type)
    {
        if (in_array($type, ['all', 'student', 'teacher', 'admin'])) {
            $this->reqData['type'] = $type;
        } else {
            throw new BaiJiaException('导出类型不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $page
     * @throws \SyException\Live\BaiJiaException
     */
    public function setPage(int $page)
    {
        if ($page > 0) {
            $this->reqData['page'] = $page;
        } else {
            throw new BaiJiaException('页数不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $pageSize
     * @throws \SyException\Live\BaiJiaException
     */
    public function setPageSize(int $pageSize)
    {
        if ($pageSize > 0) {
            $this->reqData['page_size'] = $pageSize;
        } else {
            throw new BaiJiaException('每页条数不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $dateTime
     * @throws \SyException\Live\BaiJiaException
     */
    public function setDate(int $dateTime)
    {
        if ($dateTime > 0) {
            $this->reqData['date'] = date('Y-m-d', $dateTime);
        } else {
            throw new BaiJiaException('日期不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
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
