<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 19:15
 */
namespace SyLive\Tencent\Transcode;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 创建转码模板
 *
 * @package SyLive\Tencent\Transcode
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
     * 视频码率
     *
     * @var int
     */
    private $VideoBitrate = 0;
    /**
     * 音频编码
     *
     * @var string
     */
    private $Acodec = '';
    /**
     * 音频码率
     *
     * @var int
     */
    private $AudioBitrate = 0;
    /**
     * 视频编码
     *
     * @var string
     */
    private $Vcodec = '';
    /**
     * 模板描述
     *
     * @var string
     */
    private $Description = '';
    /**
     * 宽度
     *
     * @var int
     */
    private $Width = 0;
    /**
     * 高度
     *
     * @var int
     */
    private $Height = 0;
    /**
     * 保留视频标识
     *
     * @var int
     */
    private $NeedVideo = 0;
    /**
     * 保留音频标识
     *
     * @var int
     */
    private $NeedAudio = 0;
    /**
     * 帧率
     *
     * @var int
     */
    private $Fps = 0;
    /**
     * 关键帧间隔,单位为秒
     *
     * @var int
     */
    private $Gop = 0;
    /**
     * 旋转角度
     *
     * @var int
     */
    private $Rotate = 0;
    /**
     * 编码质量
     *
     * @var string
     */
    private $Profile = '';
    /**
     * 不超过原始码率标识
     *
     * @var int
     */
    private $BitrateToOrig = 0;
    /**
     * 不超过原始高度标识
     *
     * @var int
     */
    private $HeightToOrig = 0;
    /**
     * 不超过原始帧率标识
     *
     * @var int
     */
    private $FpsToOrig = 0;
    /**
     * 极速高清模板标识
     *
     * @var int
     */
    private $AiTransCode = 0;
    /**
     * 极速高清视频码率压缩比
     *
     * @var float
     */
    private $AdaptBitratePercent = 0.0;
    /**
     * 短边作为高度标识
     *
     * @var int
     */
    private $ShortEdgeAsHeight = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'CreateLiveTranscodeTemplate';
        $this->reqData['Acodec'] = 'aac';
        $this->reqData['AudioBitrate'] = 0;
        $this->reqData['Vcodec'] = 'h264';
        $this->reqData['Width'] = 0;
        $this->reqData['Height'] = 0;
        $this->reqData['NeedVideo'] = 1;
        $this->reqData['NeedAudio'] = 1;
        $this->reqData['Fps'] = 0;
        $this->reqData['Rotate'] = 0;
        $this->reqData['BitrateToOrig'] = 0;
        $this->reqData['HeightToOrig'] = 0;
        $this->reqData['FpsToOrig'] = 0;
        $this->reqData['AiTransCode'] = 0;
        $this->reqData['ShortEdgeAsHeight'] = 0;
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
        if (ctype_alnum($templateName) && (strlen($templateName) <= 10)) {
            $this->reqData['TemplateName'] = $templateName;
        } else {
            throw new TencentException('模板名称不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $videoBitrate
     *
     * @throws \SyException\Live\TencentException
     */
    public function setVideoBitrate(int $videoBitrate)
    {
        if (($videoBitrate >= 100) && ($videoBitrate <= 8000)) {
            $this->reqData['VideoBitrate'] = $videoBitrate;
        } else {
            throw new TencentException('视频码率不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $audioBitrate
     *
     * @throws \SyException\Live\TencentException
     */
    public function setAudioBitrate(int $audioBitrate)
    {
        if (($audioBitrate >= 0) && ($audioBitrate <= 500)) {
            $this->reqData['AudioBitrate'] = $audioBitrate;
        } else {
            throw new TencentException('音频码率不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $vcodec
     *
     * @throws \SyException\Live\TencentException
     */
    public function setVcodec(string $vcodec)
    {
        if (in_array($vcodec, ['h264', 'h265', 'origin'])) {
            $this->reqData['Vcodec'] = $vcodec;
        } else {
            throw new TencentException('视频编码不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
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
     * @param int $width
     *
     * @throws \SyException\Live\TencentException
     */
    public function setWidth(int $width)
    {
        if (($width >= 0) && ($width <= 3000) && ($width % 2 == 0)) {
            $this->reqData['Width'] = $width;
        } else {
            throw new TencentException('宽度不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $height
     *
     * @throws \SyException\Live\TencentException
     */
    public function setHeight(int $height)
    {
        if (($height >= 0) && ($height <= 3000) && ($height % 2 == 0)) {
            $this->reqData['Height'] = $height;
        } else {
            throw new TencentException('高度不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $needVideo
     *
     * @throws \SyException\Live\TencentException
     */
    public function setNeedVideo(int $needVideo)
    {
        if (in_array($needVideo, [0, 1])) {
            $this->reqData['NeedVideo'] = $needVideo;
        } else {
            throw new TencentException('保留视频标识不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $needAudio
     *
     * @throws \SyException\Live\TencentException
     */
    public function setNeedAudio(int $needAudio)
    {
        if (in_array($needAudio, [0, 1])) {
            $this->reqData['NeedAudio'] = $needAudio;
        } else {
            throw new TencentException('保留音频标识不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $fps
     *
     * @throws \SyException\Live\TencentException
     */
    public function setFps(int $fps)
    {
        if (($fps >= 0) && ($fps <= 60)) {
            $this->reqData['Fps'] = $fps;
        } else {
            throw new TencentException('帧率不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $gop
     *
     * @throws \SyException\Live\TencentException
     */
    public function setGop(int $gop)
    {
        if (($gop >= 2) && ($gop <= 6)) {
            $this->reqData['Gop'] = $gop;
        } else {
            throw new TencentException('关键帧间隔不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $rotate
     *
     * @throws \SyException\Live\TencentException
     */
    public function setRotate(int $rotate)
    {
        if (in_array($rotate, [0, 90, 180, 270])) {
            $this->reqData['Rotate'] = $rotate;
        } else {
            throw new TencentException('旋转角度不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $profile
     *
     * @throws \SyException\Live\TencentException
     */
    public function setProfile(string $profile)
    {
        if (in_array($profile, ['baseline', 'main', 'high'])) {
            $this->reqData['Profile'] = $profile;
        } else {
            throw new TencentException('编码质量不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $bitrateToOrig
     *
     * @throws \SyException\Live\TencentException
     */
    public function setBitrateToOrig(int $bitrateToOrig)
    {
        if (in_array($bitrateToOrig, [0, 1])) {
            $this->reqData['BitrateToOrig'] = $bitrateToOrig;
        } else {
            throw new TencentException('不超过原始码率标识不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $heightToOrig
     *
     * @throws \SyException\Live\TencentException
     */
    public function setHeightToOrig(int $heightToOrig)
    {
        if (in_array($heightToOrig, [0, 1])) {
            $this->reqData['HeightToOrig'] = $heightToOrig;
        } else {
            throw new TencentException('不超过原始高度标识不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $fpsToOrig
     *
     * @throws \SyException\Live\TencentException
     */
    public function setFpsToOrig(int $fpsToOrig)
    {
        if (in_array($fpsToOrig, [0, 1])) {
            $this->reqData['FpsToOrig'] = $fpsToOrig;
        } else {
            throw new TencentException('不超过原始帧率标识不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $aiTransCode
     *
     * @throws \SyException\Live\TencentException
     */
    public function setAiTransCode(int $aiTransCode)
    {
        if (in_array($aiTransCode, [0, 1])) {
            $this->reqData['AiTransCode'] = $aiTransCode;
        } else {
            throw new TencentException('极速高清模板标识不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param float $adaptBitratePercent
     *
     * @throws \SyException\Live\TencentException
     */
    public function setAdaptBitratePercent(float $adaptBitratePercent)
    {
        if ((bccomp($adaptBitratePercent, 0, 1) >= 0) && (bccomp($adaptBitratePercent, 0.5, 1) <= 0)) {
            $this->reqData['AdaptBitratePercent'] = $adaptBitratePercent;
        } else {
            throw new TencentException('极速高清视频码率压缩比不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $shortEdgeAsHeight
     *
     * @throws \SyException\Live\TencentException
     */
    public function setShortEdgeAsHeight(int $shortEdgeAsHeight)
    {
        if (in_array($shortEdgeAsHeight, [0, 1])) {
            $this->reqData['ShortEdgeAsHeight'] = $shortEdgeAsHeight;
        } else {
            throw new TencentException('短边作为高度标识不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['TemplateName'])) {
            throw new TencentException('模板名称不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        if (!isset($this->reqData['VideoBitrate'])) {
            throw new TencentException('视频码率不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
