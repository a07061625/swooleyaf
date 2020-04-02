<?php
/**
 * 视频二次转码
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
 * Class CodeTransAgain
 * @package LiveEducation\BJY\VOD\Video
 */
class CodeTransAgain extends BaseBJY
{
    /**
     * 视频ID
     * @var int
     */
    private $video_id = 0;
    /**
     * 目标清晰度,多种清晰度用英文逗号分隔 1:高清 2:超清 4:720p 8:1080p 16:标清
     * @var array
     */
    private $definition = [];
    /**
     * 转码格式,多种格式用英文逗号分隔,默认是3种格式都转 1:mp4 2:flv 4:m3u8
     * @var array
     */
    private $format = [];

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/video/transcodeAgain';
        $this->format = [1, 2, 4];
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
     * @param array $definitionList
     */
    public function setDefinition(array $definitionList)
    {
        $this->definition = [];
        foreach ($definitionList as $eDefinition) {
            $trueDef = is_numeric($eDefinition) ? (int)$eDefinition : 0;
            if (in_array($trueDef, [1, 2, 4, 8, 16])) {
                $this->definition[$trueDef] = 1;
            }
        }
    }

    /**
     * @param array $formatList
     */
    public function setFormat(array $formatList)
    {
        $this->format = [];
        foreach ($formatList as $eFormat) {
            $trueFormat = is_numeric($eFormat) ? (int)$eFormat : 0;
            if (in_array($trueFormat, [1, 2, 4])) {
                $this->format[$trueFormat] = 1;
            }
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['video_id'])) {
            throw new BJYException('视频ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (empty($this->definition)) {
            throw new BJYException('目标清晰度不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        $this->reqData['definition'] = implode(',', array_keys($this->definition));
        if (empty($this->format)) {
            throw new BJYException('转码格式不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        $this->reqData['format'] = implode(',', array_keys($this->format));
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
