<?php

namespace AliOpen\Cms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of PutCustomEvent
 *
 * @method array getEventInfos()
 */
class PutCustomEventRequest extends RpcAcsRequest
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
            'PutCustomEvent',
            'cms'
        );
    }

    /**
     * @return $this
     */
    public function setEventInfos(array $eventInfo)
    {
        $this->requestParameters['EventInfos'] = $eventInfo;
        foreach ($eventInfo as $depth1 => $depth1Value) {
            $this->queryParameters['EventInfo.' . ($depth1 + 1) . '.GroupId'] = $depth1Value['GroupId'];
            $this->queryParameters['EventInfo.' . ($depth1 + 1) . '.Time'] = $depth1Value['Time'];
            $this->queryParameters['EventInfo.' . ($depth1 + 1) . '.EventName'] = $depth1Value['EventName'];
            $this->queryParameters['EventInfo.' . ($depth1 + 1) . '.Content'] = $depth1Value['Content'];
        }

        return $this;
    }
}
