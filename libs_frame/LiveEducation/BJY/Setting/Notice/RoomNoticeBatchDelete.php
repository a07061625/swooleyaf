<?php
/**
 * 删除教室公告
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 11:39
 */
namespace LiveEducation\BJY\Setting\Notice;

use LiveEducation\BJY\Setting\BaseSetting;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class RoomNoticeBatchDelete
 * @package LiveEducation\BJY\Setting\Notice
 */
class RoomNoticeBatchDelete extends BaseSetting
{
    /**
     * 房间ID
     * @var int
     */
    private $room_id = 0;
    /**
     * 公告ID列表
     * @var array
     */
    private $notice_ids = [];

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/notice/batchDeleteRoomNotice';
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
     * @param array $idList
     */
    public function setNoticeIdList(array $idList)
    {
        $this->notice_ids = [];
        foreach ($idList as $eId) {
            $trueId = is_numeric($eId) ? (int)$eId : 0;
            if ($trueId > 0) {
                $this->notice_ids[$trueId] = 1;
            }
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BJYException('房间ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (empty($this->notice_ids)) {
            throw new BJYException('公告ID列表不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        $this->reqData['notice_ids'] = implode(',', array_keys($this->notice_ids));
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
