<?php

namespace AliOpen\TradeMark;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of FilterUnavailableCodes
 * @method string getCodes()
 */
class FilterUnavailableCodesRequest extends RpcAcsRequest
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
        parent::__construct('Trademark', '2018-07-24', 'FilterUnavailableCodes', 'trademark');
    }

    /**
     * @param string $codes
     * @return $this
     */
    public function setCodes($codes)
    {
        $this->requestParameters['Codes'] = $codes;
        $this->queryParameters['Codes'] = $codes;

        return $this;
    }
}
