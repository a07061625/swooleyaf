<?php
/**
 * 设置转码回调地址(点播和回放)
 * User: 姜伟
 * Date: 2020/4/1 0001
 * Time: 18:54
 */
namespace LiveEducation\BJY\VOD\VideoAccount;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class TransCodeCallbackUrlSet
 * @package LiveEducation\BJY\VOD\VideoAccount
 */
class TransCodeCallbackUrlSet extends BaseBJY
{
    /**
     * 回调地址
     * @var string
     */
    private $url = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/video_account/setTranscodeCallbackUrl';
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
