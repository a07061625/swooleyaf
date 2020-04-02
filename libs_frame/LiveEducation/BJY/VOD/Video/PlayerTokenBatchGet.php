<?php
/**
 * 批量获取播放器token
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
 * Class PlayerTokenBatchGet
 * @package LiveEducation\BJY\VOD\Video
 */
class PlayerTokenBatchGet extends BaseBJY
{
    /**
     * 视频ID列表
     * @var array
     */
    private $video_ids = [];
    /**
     * 过期时间,单位为秒
     * @var int
     */
    private $expires_in = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/video/getPlayerTokenBatch';
        $this->reqData['expires_in'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @param array $videoIdList
     */
    public function setVideoIdList(array $videoIdList)
    {
        $this->video_ids = [];
        foreach ($videoIdList as $eVideoId) {
            $trueId = is_numeric($eVideoId) ? (int)$eVideoId : 0;
            if ($trueId > 0) {
                $this->video_ids[$trueId] = 1;
            }
        }
    }

    /**
     * @param int $expiresIn
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setExpiresIn(int $expiresIn)
    {
        if ($expiresIn >= 0) {
            $this->reqData['expires_in'] = $expiresIn;
        } else {
            throw new BJYException('过期时间不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (empty($this->video_ids)) {
            throw new BJYException('视频ID列表不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        $this->reqData['video_ids'] = implode(',', array_keys($this->video_ids));
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
