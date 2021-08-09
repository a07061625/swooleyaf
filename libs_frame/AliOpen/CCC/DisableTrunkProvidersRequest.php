<?php

namespace AliOpen\CCC;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DisableTrunkProviders
 *
 * @method array getProviderNames()
 */
class DisableTrunkProvidersRequest extends RpcAcsRequest
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
        parent::__construct(
            'CCC',
            '2017-07-05',
            'DisableTrunkProviders',
            'CCC'
        );
    }

    /**
     * @return $this
     */
    public function setProviderNames(array $providerName)
    {
        $this->requestParameters['ProviderNames'] = $providerName;
        foreach ($providerName as $i => $iValue) {
            $this->queryParameters['ProviderName.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
