<?php
/**
 * 设置水印
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 8:53
 */
namespace SyLive\BaiJia\SettingLive;

use SyLive\BaseBaiJiaSetting;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class WatermarkSet
 * @package SyLive\BaiJia\SettingLive
 */
class WatermarkSet extends BaseBaiJiaSetting
{
    /**
     * 位置 0:不启用 1:左上 2:右上 3:右下 4:左下
     * @var int
     */
    private $pos = 0;
    /**
     * 文件全路径,包括文件名
     * @var string
     */
    private $file_path = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/live_setting/setWatermark';
        $this->reqData['pos'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @param int $pos
     * @throws \SyException\Live\BaiJiaException
     */
    public function setPos(int $pos)
    {
        if (in_array($pos, [0, 1, 2, 3, 4])) {
            $this->reqData['pos'] = $pos;
        } else {
            throw new BaiJiaException('位置不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param string $filePath
     * @throws \SyException\Live\BaiJiaException
     */
    public function setFilePath(string $filePath)
    {
        if (file_exists($filePath) && is_readable($filePath)) {
            $this->file_path = $filePath;
        } else {
            throw new BaiJiaException('文件不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->file_path) == 0) {
            throw new BaiJiaException('文件不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);
        $this->reqData['attachment'] = new \CURLFile($this->file_path);

        return $this->getContent();
    }
}
