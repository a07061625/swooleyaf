<?php
/**
 * 清除指定清晰度的转码文件
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
 * Class DefinitionRemove
 * @package LiveEducation\BJY\VOD\Video
 */
class DefinitionRemove extends BaseBJY
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

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/video/removeDefinition';
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

    public function getDetail() : array
    {
        if (!isset($this->reqData['video_id'])) {
            throw new BJYException('视频ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (empty($this->definition)) {
            throw new BJYException('目标清晰度不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        $this->reqData['definition'] = implode(',', array_keys($this->definition));
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
