<?php
/**
 * 获取视频/音频上传地址
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
 * Class UploadUrlGet
 * @package LiveEducation\BJY\VOD\Video
 */
class UploadUrlGet extends BaseBJY
{
    /**
     * 文件名
     * @var string
     */
    private $file_name = '';
    /**
     * 目标清晰度,多种清晰度用英文逗号分隔 1:高清 2:超清 4:720p 8:1080p 16:标清
     * @var array
     */
    private $definition = [];
    /**
     * 是否作为音频处理 0:否 1:是
     * @var int
     */
    private $audio_with_view = 0;
    /**
     * 转码格式,多种格式用英文逗号分隔,默认是3种格式都转 1:mp4 2:flv 4:m3u8
     * @var array
     */
    private $format = [];
    /**
     * 是否生成加密格式视频/音频,默认都会加密 1:是 2:否
     * @var int
     */
    private $encrypt = 0;
    /**
     * 是否使用https上传地址,默认不使用
     * @var int
     */
    private $use_https = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/video/getUploadUrl';
        $this->format = [1, 2, 4];
        $this->reqData['audio_with_view'] = 0;
        $this->reqData['encrypt'] = 1;
        $this->reqData['use_https'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @param string $fileName
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setFileName(string $fileName)
    {
        $trueName = trim($fileName);
        if (strlen($trueName) > 0) {
            $this->reqData['file_name'] = $trueName;
        } else {
            throw new BJYException('文件名不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
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
     * @param int $audioWithView
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setAudioWithView(int $audioWithView)
    {
        if (in_array($audioWithView, [0, 1])) {
            $this->reqData['audio_with_view'] = $audioWithView;
        } else {
            throw new BJYException('音频处理标识不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
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

    /**
     * @param int $encrypt
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setEncrypt(int $encrypt)
    {
        if (in_array($encrypt, [1, 2])) {
            $this->reqData['encrypt'] = $encrypt;
        } else {
            throw new BJYException('生成加密格式标识不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
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
        if (!isset($this->reqData['file_name'])) {
            throw new BJYException('文件名不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
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
