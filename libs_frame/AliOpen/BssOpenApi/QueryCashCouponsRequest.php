<?php

namespace AliOpen\BssOpenApi;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of QueryCashCoupons
 *
 * @method string getExpiryTimeEnd()
 * @method string getExpiryTimeStart()
 * @method string getEffectiveOrNot()
 */
class QueryCashCouponsRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('BssOpenApi', '2017-12-14', 'QueryCashCoupons', 'BssOpenApi');
    }

    /**
     * @param string $expiryTimeEnd
     *
     * @return $this
     */
    public function setExpiryTimeEnd($expiryTimeEnd)
    {
        $this->requestParameters['ExpiryTimeEnd'] = $expiryTimeEnd;
        $this->queryParameters['ExpiryTimeEnd'] = $expiryTimeEnd;

        return $this;
    }

    /**
     * @param string $expiryTimeStart
     *
     * @return $this
     */
    public function setExpiryTimeStart($expiryTimeStart)
    {
        $this->requestParameters['ExpiryTimeStart'] = $expiryTimeStart;
        $this->queryParameters['ExpiryTimeStart'] = $expiryTimeStart;

        return $this;
    }

    /**
     * @param string $effectiveOrNot
     *
     * @return $this
     */
    public function setEffectiveOrNot($effectiveOrNot)
    {
        $this->requestParameters['EffectiveOrNot'] = $effectiveOrNot;
        $this->queryParameters['EffectiveOrNot'] = $effectiveOrNot;

        return $this;
    }
}
