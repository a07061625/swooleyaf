<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 23:10
 */
namespace SyLive\Tencent\Record;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 创建录制模板
 *
 * @package SyLive\Tencent\Record
 */
class TemplateCreate extends BaseTencent
{
    /**
     * 模板名称
     *
     * @var string
     */
    private $TemplateName = '';
    /**
     * 描述信息
     *
     * @var string
     */
    private $Description = '';
    /**
     * FLV录制参数
     *
     * @var array
     */
    private $FlvParam = [];
    /**
     * HLS录制参数
     *
     * @var array
     */
    private $HlsParam = [];
    /**
     * MP4录制参数
     *
     * @var array
     */
    private $Mp4Param = [];
    /**
     * AAC录制参数
     *
     * @var array
     */
    private $AacParam = [];
    /**
     * 直播类型
     *
     * @var int
     */
    private $IsDelayLive = 0;
    /**
     * HLS录制定制参数
     *
     * @var array
     */
    private $HlsSpecialParam = [];
    /**
     * MP3录制参数
     *
     * @var array
     */
    private $Mp3Param = [];

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'CreateLiveRecordTemplate';
        $this->reqData['IsDelayLive'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @param string $templateName
     *
     * @throws \SyException\Live\TencentException
     */
    public function setTemplateName(string $templateName)
    {
        if (strlen($templateName) > 0) {
            $this->reqData['TemplateName'] = $templateName;
        } else {
            throw new TencentException('模板名称不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->reqData['Description'] = trim($description);
    }

    /**
     * @param array $flvParam
     *
     * @throws \SyException\Live\TencentException
     */
    public function setFlvParam(array $flvParam)
    {
        if (empty($flvParam)) {
            throw new TencentException('FLV录制参数不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        $this->reqData['FlvParam'] = $flvParam;
    }

    /**
     * @param array $hlsParam
     *
     * @throws \SyException\Live\TencentException
     */
    public function setHlsParam(array $hlsParam)
    {
        if (empty($hlsParam)) {
            throw new TencentException('HLS录制参数不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        $this->reqData['HlsParam'] = $hlsParam;
    }

    /**
     * @param array $mp4Param
     *
     * @throws \SyException\Live\TencentException
     */
    public function setMp4Param(array $mp4Param)
    {
        if (empty($mp4Param)) {
            throw new TencentException('MP4录制参数不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        $this->reqData['Mp4Param'] = $mp4Param;
    }

    /**
     * @param array $aacParam
     *
     * @throws \SyException\Live\TencentException
     */
    public function setAacParam(array $aacParam)
    {
        if (empty($aacParam)) {
            throw new TencentException('AAC录制参数不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        $this->reqData['AacParam'] = $aacParam;
    }

    /**
     * @param int $isDelayLive
     *
     * @throws \SyException\Live\TencentException
     */
    public function setIsDelayLive(int $isDelayLive)
    {
        if (in_array($isDelayLive, [0, 1])) {
            $this->reqData['IsDelayLive'] = $isDelayLive;
        } else {
            throw new TencentException('直播类型不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param array $hlsSpecialParam
     *
     * @throws \SyException\Live\TencentException
     */
    public function setHlsSpecialParam(array $hlsSpecialParam)
    {
        if (empty($hlsSpecialParam)) {
            throw new TencentException('HLS录制定制参数不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        $this->reqData['HlsSpecialParam'] = $hlsSpecialParam;
    }

    /**
     * @param array $mp3Param
     *
     * @throws \SyException\Live\TencentException
     */
    public function setMp3Param(array $mp3Param)
    {
        if (empty($mp3Param)) {
            throw new TencentException('MP3录制参数不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        $this->reqData['Mp3Param'] = $mp3Param;
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['TemplateName'])) {
            throw new TencentException('模板名称不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
