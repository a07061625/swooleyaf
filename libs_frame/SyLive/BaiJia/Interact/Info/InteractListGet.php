<?php
/**
 * 获取签到汇总数据
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 15:24
 */
namespace SyLive\BaiJia\Interact\Info;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class InteractListGet
 * @package SyLive\BaiJia\Interact\Info
 */
class InteractListGet extends BaseBaiJia
{
    /**
     * 房间ID
     * @var int
     */
    private $room_id = 0;
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
     * 开始时间
     * @var string
     */
    private $begin_time = '';
    /**
     * 结束时间
     * @var string
     */
    private $end_time = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceDomain = 'http://hudong.baijiayun.com';
        $this->serviceUri = '/openapi/interact_info/getInteractList';
        $this->reqData['type'] = 'checkin';
        $this->reqData['page'] = 1;
        $this->reqData['page_size'] = 20;
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
     * @param int $beginTime
     * @param int $endTime
     * @throws \SyException\Live\BaiJiaException
     */
    public function setTime(int $beginTime, int $endTime)
    {
        if ($beginTime < 0) {
            throw new BaiJiaException('开始时间不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        } elseif ($endTime < 0) {
            throw new BaiJiaException('结束时间不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        } elseif ($beginTime > $endTime) {
            throw new BaiJiaException('开始时间不能大于结束时间', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }

        unset($this->reqData['begin_time'], $this->reqData['end_time']);
        if ($beginTime > 0) {
            $this->reqData['begin_time'] = date('Y-m-d', $beginTime);
        }
        if ($endTime > 0) {
            $this->reqData['end_time'] = date('Y-m-d', $endTime);
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
