<?php
/**
 * 解析出淘口令原链接
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:38
 */

namespace SyPromotion\TBK\Common;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class TPwdParse
 *
 * @package SyPromotion\TBK\Common
 */
class TPwdParse extends BaseTBK
{
    /**
     * 淘口令
     *
     * @var string
     */
    private $password_content = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.tpwd.parse');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPasswordContent(string $passwordContent)
    {
        if (\strlen($passwordContent) > 0) {
            $this->reqData['password_content'] = $passwordContent;
        } else {
            throw new TBKException('淘口令不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['password_content'])) {
            throw new TBKException('淘口令不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
