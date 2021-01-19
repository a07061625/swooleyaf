<?php
/**
 * 生成淘口令
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:38
 */

namespace SyPromotion\TBK\Common;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class TPwdCreate
 *
 * @package SyPromotion\TBK\Common
 */
class TPwdCreate extends BaseTBK
{
    /**
     * 淘宝用户ID
     *
     * @var string
     */
    private $user_id = '';
    /**
     * 口令弹框内容
     *
     * @var string
     */
    private $text = '';
    /**
     * 口令跳转目标页
     *
     * @var string
     */
    private $url = '';
    /**
     * 口令弹框logo
     *
     * @var string
     */
    private $logo = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.tpwd.create');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setUserId(string $userId)
    {
        if (ctype_alnum($userId)) {
            $this->reqData['user_id'] = $userId;
        } else {
            throw new TBKException('淘宝用户ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setText(string $text)
    {
        if (\strlen($text) > 5) {
            $this->reqData['text'] = $text;
        } else {
            throw new TBKException('弹框内容不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setUrl(string $url)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $url) > 0) {
            $this->reqData['url'] = $url;
        } else {
            throw new TBKException('跳转目标页不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setLogo(string $logo)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $logo) > 0) {
            $this->reqData['logo'] = $logo;
        } else {
            throw new TBKException('弹框logo不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['text'])) {
            throw new TBKException('弹框内容不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['url'])) {
            throw new TBKException('跳转目标页不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
