<?php

namespace AliOpen\Cms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DisableHostAvailability
 *
 * @method array getIds()
 */
class DisableHostAvailabilityRequest extends RpcAcsRequest
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
            'Cms',
            '2019-01-01',
            'DisableHostAvailability',
            'cms'
        );
    }

    /**
     * @return $this
     */
    public function setIds(array $id)
    {
        $this->requestParameters['Ids'] = $id;
        foreach ($id as $i => $iValue) {
            $this->queryParameters['Id.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}