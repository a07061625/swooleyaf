<?php
/**
 * 添加小测
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
 * Class QuizAdd
 * @package SyLive\BaiJia\SettingLive
 */
class QuizAdd extends BaseBaiJiaSetting
{
    /**
     * 强制参加标识 0:不强制参加 1:强制参加
     * @var int
     */
    private $is_force = 0;
    /**
     * 文件全路径,包括文件名
     * @var string
     */
    private $file_path = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/live_setting/addQuiz';
        $this->reqData['is_force'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @param int $isForce
     * @throws \SyException\Live\BaiJiaException
     */
    public function setIsForce(int $isForce)
    {
        if (in_array($isForce, [0, 1])) {
            $this->reqData['is_force'] = $isForce;
        } else {
            throw new BaiJiaException('强制参加标识不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
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
