<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/20 0020
 * Time: 14:00
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Class SignPubKeyCertTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait SignPubKeyCertTrait
{
    /**
     * @param string $signPubKeyCert
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setSignPubKeyCert(string $signPubKeyCert)
    {
        if (strlen($signPubKeyCert) > 0) {
            $this->reqData['signPubKeyCert'] = $signPubKeyCert;
        } else {
            throw new UnionException('签名公钥证书不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
