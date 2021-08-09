<?php

namespace AliOpen\Cms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteHostAvailability
 *
 * @method array getIds()
 */
class DeleteHostAvailabilityRequest extends RpcAcsRequest
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
            'DeleteHostAvailability',
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
