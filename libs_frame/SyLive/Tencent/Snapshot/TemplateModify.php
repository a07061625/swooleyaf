<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 16:51
 */
namespace SyLive\Tencent\Snapshot;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 修改截图模板
 *
 * @package SyLive\Tencent\Snapshot
 */
class TemplateModify extends BaseTencent
{
    /**
     * 模板ID
     *
     * @var int
     */
    private $TemplateId = 0;
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
     * 截图间隔,单位s
     *
     * @var int
     */
    private $SnapshotInterval = 0;
    /**
     * 截图宽度
     *
     * @var int
     */
    private $Width = 0;
    /**
     * 截图高度
     *
     * @var int
     */
    private $Height = 0;
    /**
     * 鉴黄标识
     *
     * @var int
     */
    private $PornFlag = 0;
    /**
     * Cos应用ID
     *
     * @var int
     */
    private $CosAppId = 0;
    /**
     * Cos Bucket名称
     *
     * @var string
     */
    private $CosBucket = '';
    /**
     * Cos地域
     *
     * @var string
     */
    private $CosRegion = '';
    /**
     * Cos Bucket文件夹前缀
     *
     * @var string
     */
    private $CosPrefix = '';
    /**
     * Cos文件名称
     *
     * @var string
     */
    private $CosFileName = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'ModifyLiveSnapshotTemplate';
        $this->reqData['SnapshotInterval'] = 10;
        $this->reqData['Width'] = 0;
        $this->reqData['Height'] = 0;
        $this->reqData['PornFlag'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @param int $templateId
     *
     * @throws \SyException\Live\TencentException
     */
    public function setTemplateId(int $templateId)
    {
        if ($templateId > 0) {
            $this->reqData['TemplateId'] = $templateId;
        } else {
            throw new TencentException('模板ID不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $templateName
     *
     * @throws \SyException\Live\TencentException
     */
    public function setTemplateName(string $templateName)
    {
        $length = strlen($templateName);
        if (($length > 0) && ($length <= 255)) {
            $this->reqData['TemplateName'] = $templateName;
        } else {
            throw new TencentException('模板名称不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $description
     *
     * @throws \SyException\Live\TencentException
     */
    public function setDescription(string $description)
    {
        if (strlen($description) <= 1024) {
            $this->reqData['Description'] = $description;
        } else {
            throw new TencentException('描述信息不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $snapshotInterval
     *
     * @throws \SyException\Live\TencentException
     */
    public function setSnapshotInterval(int $snapshotInterval)
    {
        if (($snapshotInterval >= 5) && ($snapshotInterval <= 300)) {
            $this->reqData['SnapshotInterval'] = $snapshotInterval;
        } else {
            throw new TencentException('截图间隔不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $width
     *
     * @throws \SyException\Live\TencentException
     */
    public function setWidth(int $width)
    {
        if ($width >= 0) {
            $this->reqData['Width'] = $width;
        } else {
            throw new TencentException('截图宽度不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $height
     *
     * @throws \SyException\Live\TencentException
     */
    public function setHeight(int $height)
    {
        if ($height >= 0) {
            $this->reqData['Height'] = $height;
        } else {
            throw new TencentException('截图高度不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $pornFlag
     *
     * @throws \SyException\Live\TencentException
     */
    public function setPornFlag(int $pornFlag)
    {
        if (in_array($pornFlag, [0, 1])) {
            $this->reqData['PornFlag'] = $pornFlag;
        } else {
            throw new TencentException('鉴黄标识不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $cosAppId
     *
     * @throws \SyException\Live\TencentException
     */
    public function setCosAppId(int $cosAppId)
    {
        if ($cosAppId > 0) {
            $this->reqData['CosAppId'] = $cosAppId;
        } else {
            throw new TencentException('Cos应用ID不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $cosBucket
     *
     * @throws \SyException\Live\TencentException
     */
    public function setCosBucket(string $cosBucket)
    {
        if (strlen($cosBucket) > 0) {
            $this->reqData['CosBucket'] = $cosBucket;
        } else {
            throw new TencentException('Cos Bucket名称不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $cosRegion
     *
     * @throws \SyException\Live\TencentException
     */
    public function setCosRegion(string $cosRegion)
    {
        if (strlen($cosRegion) > 0) {
            $this->reqData['CosRegion'] = $cosRegion;
        } else {
            throw new TencentException('Cos地域不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $cosPrefix
     *
     * @throws \SyException\Live\TencentException
     */
    public function setCosPrefix(string $cosPrefix)
    {
        if (strlen($cosPrefix) > 0) {
            $this->reqData['CosPrefix'] = $cosPrefix;
        } else {
            throw new TencentException('Cos Bucket文件夹前缀不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $cosFileName
     *
     * @throws \SyException\Live\TencentException
     */
    public function setCosFileName(string $cosFileName)
    {
        if (strlen($cosFileName) > 0) {
            $this->reqData['CosFileName'] = $cosFileName;
        } else {
            throw new TencentException('Cos文件名称不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['TemplateId'])) {
            throw new TencentException('模板ID不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
