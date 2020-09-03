<?php
/**
 * 小测关联直播间
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 11:39
 */
namespace SyLive\BaiJia\SettingQuiz;

use SyLive\BaseBaiJiaSetting;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class RoomPaperAssign
 * @package SyLive\BaiJia\SettingQuiz
 */
class RoomPaperAssign extends BaseBaiJiaSetting
{
    /**
     * 房间ID
     * @var int
     */
    private $room_id = 0;
    /**
     * 试卷ID列表
     * @var array
     */
    private $paper_ids = [];

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/quiz/assignRoomPaper';
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
     * @param array $idList
     */
    public function setPaperIdList(array $idList)
    {
        $this->paper_ids = [];
        foreach ($idList as $eId) {
            $trueId = is_numeric($eId) ? (int)$eId : 0;
            if ($trueId > 0) {
                $this->paper_ids[$trueId] = 1;
            }
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BaiJiaException('房间ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (empty($this->paper_ids)) {
            throw new BaiJiaException('试卷ID列表不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        $this->reqData['paper_ids'] = implode(',', array_keys($this->paper_ids));
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
