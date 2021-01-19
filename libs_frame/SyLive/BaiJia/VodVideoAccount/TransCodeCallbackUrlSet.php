<?php
/**
 * 设置转码回调地址(点播和回放)
 * User: 姜伟
 * Date: 2020/4/1 0001
 * Time: 18:54
 */

namespace SyLive\BaiJia\VodVideoAccount;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Live\BaiJiaException;
use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;

/**
 * Class TransCodeCallbackUrlSet
 *
 * @package SyLive\BaiJia\VodVideoAccount
 */
class TransCodeCallbackUrlSet extends BaseBaiJia
{
    /**
     * 回调地址
     *
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
     * @throws \SyException\Live\BaiJiaException
     */
    public function setUrl(string $url)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $url) > 0) {
            $this->reqData['url'] = $url;
        } else {
            throw new BaiJiaException('回调地址不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['url'])) {
            throw new BaiJiaException('回调地址不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
