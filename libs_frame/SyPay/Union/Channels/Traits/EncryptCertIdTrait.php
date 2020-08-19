<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:11
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Class EncryptCertIdTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait EncryptCertIdTrait
{
    /**
     * @param string $encryptCertId
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setEncryptCertId(string $encryptCertId)
    {
        if (ctype_digit($encryptCertId)) {
            $this->reqData['encryptCertId'] = $encryptCertId;
        } else {
            throw new UnionException('加密证书ID不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
