<?php
/**
 * 设置教室公告
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 10:44
 */
namespace LiveEducation\BJY\Live\LargeClass\Live;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class NotifySet
 * @package LiveEducation\BJY\Live\LargeClass\Live
 */
class NotifySet extends BaseBJY
{
    /**
     * 房间ID
     * @var int
     */
    private $room_id = 0;
    /**
     * 公告信息
     * @var string
     */
    private $content = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/live/setNotify';
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
     * @param string $content
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setContent(string $content)
    {
        $trueContent = trim($content);
        if (strlen($trueContent) > 0) {
            $this->reqData['content'] = $trueContent;
        } else {
            throw new BJYException('公告信息不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BJYException('房间ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (!isset($this->reqData['content'])) {
            throw new BJYException('公告信息不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
