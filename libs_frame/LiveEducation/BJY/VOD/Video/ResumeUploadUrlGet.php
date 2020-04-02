<?php
/**
 * 获取断点续传地址
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
 * Class ResumeUploadUrlGet
 * @package LiveEducation\BJY\VOD\Video
 */
class ResumeUploadUrlGet extends BaseBJY
{
    /**
     * 视频ID
     * @var int
     */
    private $video_id = 0;
    /**
     * 是否使用https上传地址,默认不使用
     * @var int
     */
    private $use_https = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/video/getResumeUploadUrl';
        $this->reqData['use_https'] = 0;
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
     * @param int $useHttps
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setUseHttps(int $useHttps)
    {
        if (in_array($useHttps, [0, 1])) {
            $this->reqData['use_https'] = $useHttps;
        } else {
            throw new BJYException('使用https上传地址标识不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['video_id'])) {
            throw new BJYException('视频ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
