<?php
/**
 * 删除小测模板
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
 * Class QuizDelete
 * @package LiveEducation\BJY\Setting\Live
 */
class QuizDelete extends BaseSetting
{
    /**
     * 小测ID
     * @var int
     */
    private $id = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/live_setting/deleteQuiz';
    }

    private function __clone()
    {
    }

    /**
     * @param int $id
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setId(int $id)
    {
        if ($id > 0) {
            $this->reqData['id'] = $id;
        } else {
            throw new BJYException('小测ID不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['id'])) {
            throw new BJYException('小测ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
