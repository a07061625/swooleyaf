<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 10:56
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Class MerInfoTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait MerInfoTrait
{
    /**
     * @param string $merAbbr 商户简称
     */
    public function setMerAbbr(string $merAbbr)
    {
        if (strlen($merAbbr) > 0) {
            $this->reqData['merAbbr'] = $merAbbr;
        }
    }

    /**
     * @param string $merCatCode 商户类别
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setMerCatCode(string $merCatCode)
    {
        if (ctype_digit($merCatCode) && (strlen($merCatCode) == 4)) {
            $this->reqData['merCatCode'] = $merCatCode;
        } else {
            throw new UnionException('商户类别不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $merName 商户名称
     */
    public function setMerName(string $merName)
    {
        if (strlen($merName)) {
            $this->reqData['merName'] = $merName;
        }
    }
}
