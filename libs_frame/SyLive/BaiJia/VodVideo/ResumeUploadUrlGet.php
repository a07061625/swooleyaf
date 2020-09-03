<?php
/**
 * 获取断点续传地址
 * User: 姜伟
 * Date: 2020/4/1 0001
 * Time: 18:54
 */
namespace SyLive\BaiJia\VodVideo;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class ResumeUploadUrlGet
 * @package SyLive\BaiJia\VodVideo
 */
class ResumeUploadUrlGet extends BaseBaiJia
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
     * @throws \SyException\Live\BaiJiaException
     */
    public function setVideoId(int $videoId)
    {
        if ($videoId > 0) {
            $this->reqData['video_id'] = $videoId;
        } else {
            throw new BaiJiaException('视频ID不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $useHttps
     * @throws \SyException\Live\BaiJiaException
     */
    public function setUseHttps(int $useHttps)
    {
        if (in_array($useHttps, [0, 1])) {
            $this->reqData['use_https'] = $useHttps;
        } else {
            throw new BaiJiaException('使用https上传地址标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['video_id'])) {
            throw new BaiJiaException('视频ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
