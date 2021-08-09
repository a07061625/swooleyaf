<?php

namespace AliOpen\FinMall;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetUserInfoAuthorizationAgreement
 *
 * @method string getCreditId()
 * @method string getFundPartyId()
 * @method string getUserId()
 */
class GetUserInfoAuthorizationAgreementRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('finmall', '2018-07-23', 'GetUserInfoAuthorizationAgreement', 'finmall');
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
