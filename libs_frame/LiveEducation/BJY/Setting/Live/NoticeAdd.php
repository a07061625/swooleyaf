<?php
/**
 * 添加公告模板
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
 * Class NoticeAdd
 * @package LiveEducation\BJY\Setting\Live
 */
class NoticeAdd extends BaseSetting
{
    /**
     * 内容
     * @var string
     */
    private $content = '';
    /**
     * 链接
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
     * @param string $content
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setContent(string $content)
    {
        $trueContent = trim($content);
        if (strlen($trueContent) > 0) {
            $this->reqData['content'] = $trueContent;
        } else {
            throw new BJYException('内容不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param string $link
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setLink(string $link)
    {
        if (preg_match('/^(http|https)\:\/\/\S+$/', $link) > 0) {
            $this->reqData['link'] = $link;
        } else {
            throw new BJYException('链接不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['content'])) {
            throw new BJYException('内容不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (!isset($this->reqData['link'])) {
            throw new BJYException('链接不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
