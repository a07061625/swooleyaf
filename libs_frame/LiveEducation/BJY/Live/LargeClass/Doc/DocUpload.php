<?php
/**
 * 直播课件文档上传
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
 * Class DocUpload
 * @package LiveEducation\BJY\Live\LargeClass\Doc
 */
class DocUpload extends BaseBJY
{
    /**
     * 房间ID
     * @var int
     */
    private $room_id = 0;
    /**
     * 动效PPT标识,只针对PPT有效 0:非动效 1:动效
     * @var int
     */
    private $ppt_animation = 0;
    /**
     * 文件全路径,包括文件名
     * @var string
     */
    private $file_path = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/doc/uploadDoc';
        $this->reqData['ppt_animation'] = 0;
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
     * @param int $pptAnimation
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setPptAnimation(int $pptAnimation)
    {
        if (in_array($pptAnimation, [0, 1])) {
            $this->reqData['ppt_animation'] = $pptAnimation;
        } else {
            throw new BJYException('动效PPT标识不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param string $filePath
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setFilePath(string $filePath)
    {
        if (file_exists($filePath) && is_readable($filePath)) {
            $this->file_path = $filePath;
        } else {
            throw new BJYException('文件不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->file_path) == 0) {
            throw new BJYException('文件不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);
        $this->reqData['attachment'] = new \CURLFile($this->file_path);

        return $this->getContent();
    }
}
