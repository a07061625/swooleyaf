<?php

namespace AliOpen\FinMall;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetLoanAgreement
 *
 * @method string getCreditId()
 * @method string getFundPartyId()
 * @method string getReturnUrl()
 * @method string getUserId()
 */
class GetLoanAgreementRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('finmall', '2018-07-23', 'GetLoanAgreement', 'finmall');
    }

    /**
     * @param string $creditId
     *
     * @return $this
     */
    public function setCreditId($creditId)
    {
        $this->requestParameters['CreditId'] = $creditId;
        $this->queryParameters['CreditId'] = $creditId;

        return $this;
    }

    /**
     * @param string $fundPartyId
     *
     * @return $this
     */
    public function setFundPartyId($fundPartyId)
    {
        $this->requestParameters['FundPartyId'] = $fundPartyId;
        $this->queryParameters['FundPartyId'] = $fundPartyId;

        return $this;
    }

    /**
     * @param string $returnUrl
     *
     * @return $this
     */
    public function setReturnUrl($returnUrl)
    {
        $this->requestParameters['ReturnUrl'] = $returnUrl;
        $this->queryParameters['ReturnUrl'] = $returnUrl;

        return $this;
    }

    /**
     * @param string $userId
     *
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->requestParameters['UserId'] = $userId;
        $this->queryParameters['UserId'] = $userId;

        return $this;
    }
}
