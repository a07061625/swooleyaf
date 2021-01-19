<?php
/**
 * 设置直播上下课事件回调地址
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 11:50
 */

namespace SyLive\BaiJia\LiveLargeClass\LiveAccount;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Live\BaiJiaException;
use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;

/**
 * Class ClassCallbackUrlSet
 *
 * @package SyLive\BaiJia\LiveLargeClass\LiveAccount
 */
class ClassCallbackUrlSet extends BaseBaiJia
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
        $this->serviceUri = '/openapi/live_account/setClassCallbackUrl';
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
