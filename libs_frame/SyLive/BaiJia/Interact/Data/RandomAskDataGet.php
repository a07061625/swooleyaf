<?php
/**
 * 获取班级随机点名数据
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 15:42
 */
namespace SyLive\BaiJia\Interact\Data;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class RandomAskDataGet
 * @package SyLive\BaiJia\Interact\Data
 */
class RandomAskDataGet extends BaseBaiJia
{
    /**
     * 房间ID
     * @var int
     */
    private $room_id = 0;
    /**
     * 类型 不传:所有 0:随机选班级 1:随机选学生
     * @var int
     */
    private $type = 0;
    /**
     * 日期
     * @var string
     */
    private $date = '';
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

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceDomain = 'http://hudong.baijiayun.com';
        $this->serviceUri = '/openapi/interact_data/getRandomAskData';
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
     * @param int $type
     * @throws \SyException\Live\BaiJiaException
     */
    public function setType(int $type)
    {
        if (in_array($type, [0, 1])) {
            $this->reqData['type'] = $type;
        } else {
            throw new BaiJiaException('类型不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $dateTime
     * @throws \SyException\Live\BaiJiaException
     */
    public function setDate(int $dateTime)
    {
        if ($dateTime > 1262275200) {
            $this->reqData['date'] = date('Y-m-d', $dateTime);
        } else {
            throw new BaiJiaException('日期不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
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

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BaiJiaException('房间ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
