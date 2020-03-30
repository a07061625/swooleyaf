<?php
/**
 * 获取用户参加码信息
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 8:26
 */
namespace LiveEducation\BJY\Live\LargeClass\Room;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class CodeInfoGet
 * @package LiveEducation\BJY\Live\LargeClass\Room
 */
class CodeInfoGet extends BaseBJY
{
    /**
     * 参加码
     * @var string
     */
    private $code = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/room/getCodeInfo';
    }

    private function __clone()
    {
    }

    /**
     * @param string $code
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setCode(string $code)
    {
        if (ctype_alnum($code)) {
            $this->reqData['code'] = $code;
        } else {
            throw new BJYException('参加码不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['code'])) {
            throw new BJYException('参加码不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
