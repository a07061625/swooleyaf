<?php
/**
 * 添加小测
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 8:53
 */
namespace LiveEducation\BJY\Setting\Live;

use LiveEducation\BJY\Setting\BaseSetting;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class QuizAdd
 * @package LiveEducation\BJY\Setting\Live
 */
class QuizAdd extends BaseSetting
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
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setIsForce(int $isForce)
    {
        if (in_array($isForce, [0, 1])) {
            $this->reqData['is_force'] = $isForce;
        } else {
            throw new BJYException('强制参加标识不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
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
