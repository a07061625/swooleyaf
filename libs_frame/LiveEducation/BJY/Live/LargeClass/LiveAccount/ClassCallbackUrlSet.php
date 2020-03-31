<?php
/**
 * 设置直播上下课事件回调地址
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 11:50
 */
namespace LiveEducation\BJY\Live\LargeClass\LiveAccount;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class ClassCallbackUrlSet
 * @package LiveEducation\BJY\Live\LargeClass\LiveAccount
 */
class ClassCallbackUrlSet extends BaseBJY
{
    /**
     * 回调地址
     * @var string
     */
    private $url = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/live_account/setClassCallbackUrl';
    }

    private function __clone()
    {
    }

    /**
     * @param string $url
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setUrl(string $url)
    {
        if (preg_match('/^(http|https)\:\/\/\S+$/', $url) > 0) {
            $this->reqData['url'] = $url;
        } else {
            throw new BJYException('回调地址不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['url'])) {
            throw new BJYException('回调地址不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
