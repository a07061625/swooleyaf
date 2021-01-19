<?php
/**
 * 联盟口令生成
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class TextTPwdCreate
 *
 * @package SyPromotion\TBK\Promoter
 */
class TextTPwdCreate extends BaseTBK
{
    /**
     * 淘宝用户ID
     *
     * @var string
     */
    private $user_id = '';
    /**
     * 弹框内容
     *
     * @var string
     */
    private $text = '';
    /**
     * 跳转目标页
     *
     * @var string
     */
    private $url = '';
    /**
     * 弹框logo
     *
     * @var string
     */
    private $logo = '';
    /**
     * 类型
     *
     * @var string
     */
    private $password_type = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.text.tpwd.create');
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
        if (\strlen($text) >= 5) {
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

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPasswordType(string $passwordType)
    {
        if (\strlen($passwordType) > 0) {
            $this->reqData['password_type'] = $passwordType;
        } else {
            throw new TBKException('类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['url'])) {
            throw new TBKException('跳转目标页不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['password_type'])) {
            throw new TBKException('类型不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
