<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 10:58
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Class CertIdTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait CertIdTrait
{
    /**
     * @param string $certId
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setCertId(string $certId)
    {
        if (ctype_digit($certId)) {
            $this->reqData['certId'] = $certId;
        } else {
            throw new UnionException('证书ID不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
