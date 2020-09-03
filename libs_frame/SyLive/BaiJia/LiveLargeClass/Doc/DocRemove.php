<?php
/**
 * 移除教室内文档
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 8:55
 */
namespace SyLive\BaiJia\LiveLargeClass\Doc;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class DocRemove
 * @package SyLive\BaiJia\LiveLargeClass\Doc
 */
class DocRemove extends BaseBaiJia
{
    /**
     * 房间ID
     * @var int
     */
    private $room_id = 0;
    /**
     * 文档ID
     * @var int
     */
    private $fid = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/doc/removeDoc';
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
     * @param int $fid
     * @throws \SyException\Live\BaiJiaException
     */
    public function setFid(int $fid)
    {
        if ($fid > 0) {
            $this->reqData['fid'] = $fid;
        } else {
            throw new BaiJiaException('文档ID不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BaiJiaException('房间ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (!isset($this->reqData['fid'])) {
            throw new BaiJiaException('文档ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
