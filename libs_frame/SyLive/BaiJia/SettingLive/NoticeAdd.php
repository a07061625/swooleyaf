<?php
/**
 * 添加公告模板
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 8:53
 */

namespace SyLive\BaiJia\SettingLive;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Live\BaiJiaException;
use SyLive\BaseBaiJiaSetting;
use SyLive\UtilBaiJia;

/**
 * Class NoticeAdd
 *
 * @package SyLive\BaiJia\SettingLive
 */
class NoticeAdd extends BaseBaiJiaSetting
{
    /**
     * 内容
     *
     * @var string
     */
    private $content = '';
    /**
     * 链接
     *
     * @var string
     */
    private $link = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/live_setting/addNotice';
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Live\BaiJiaException
     */
    public function setContent(string $content)
    {
        $trueContent = trim($content);
        if (\strlen($trueContent) > 0) {
            $this->reqData['content'] = $trueContent;
        } else {
            throw new BaiJiaException('内容不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Live\BaiJiaException
     */
    public function setLink(string $link)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $link) > 0) {
            $this->reqData['link'] = $link;
        } else {
            throw new BaiJiaException('链接不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['content'])) {
            throw new BaiJiaException('内容不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (!isset($this->reqData['link'])) {
            throw new BaiJiaException('链接不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
