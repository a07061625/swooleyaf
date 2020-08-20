<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 10:54
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Trait PayeeInfoTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait PayeeInfoTrait
{
    /**
     * @param string $payeeAcctNo 收款方账号
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setPayeeAcctNo(string $payeeAcctNo)
    {
        if (ctype_digit($payeeAcctNo) && (strlen($payeeAcctNo) <= 34)) {
            $this->reqData['payeeAcctNo'] = $payeeAcctNo;
        } else {
            throw new UnionException('收款方账号不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $payeeAcctNm 收款方账户名称
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setPayeeAcctNm(string $payeeAcctNm)
    {
        if (strlen($payeeAcctNm) > 0) {
            $this->reqData['payeeAcctNm'] = $payeeAcctNm;
        } else {
            throw new UnionException('收款方账户名称不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @param string $payeeBankName 收款银行名称
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setPayeeBankName(string $payeeBankName)
    {
        if (strlen($payeeBankName) > 0) {
            $this->reqData['payeeBankName'] = $payeeBankName;
        } else {
            throw new UnionException('收款银行名称不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
