<?php
/**
 * 设置视频发布状态
 * User: 姜伟
 * Date: 2020/4/1 0001
 * Time: 18:54
 */
namespace LiveEducation\BJY\VOD\Video;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class PublishStatusSet
 * @package LiveEducation\BJY\VOD\Video
 */
class PublishStatusSet extends BaseBJY
{
    /**
     * 视频ID
     * @var int
     */
    private $video_id = 0;
    /**
     * 发布状态 1:发布 2:屏蔽
     * @var int
     */
    private $status = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/video/setPublishStatus';
    }

    private function __clone()
    {
    }

    /**
     * @param int $videoId
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setVideoId(int $videoId)
    {
        if ($videoId > 0) {
            $this->reqData['video_id'] = $videoId;
        } else {
            throw new BJYException('视频ID不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param int $status
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setStatus(int $status)
    {
        if (in_array($status, [1, 2])) {
            $this->reqData['status'] = $status;
        } else {
            throw new BJYException('发布状态不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['video_id'])) {
            throw new BJYException('视频ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (!isset($this->reqData['status'])) {
            throw new BJYException('发布状态不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
