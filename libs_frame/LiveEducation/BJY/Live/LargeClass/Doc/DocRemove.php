<?php
/**
 * 移除教室内文档
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 8:55
 */
namespace LiveEducation\BJY\Live\LargeClass\Doc;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class DocRemove
 * @package LiveEducation\BJY\Live\LargeClass\Doc
 */
class DocRemove extends BaseBJY
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
     * @param int $fid
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setFid(int $fid)
    {
        if ($fid > 0) {
            $this->reqData['fid'] = $fid;
        } else {
            throw new BJYException('文档ID不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BJYException('房间ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (!isset($this->reqData['fid'])) {
            throw new BJYException('文档ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
