<?php

namespace AliOpen\CloudPhoto;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetEvent
 *
 * @method string getEventId()
 * @method string getLibraryId()
 * @method string getStoreName()
 */
class GetEventRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $requestScheme = 'https';

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
            'CloudPhoto',
            '2017-07-11',
            'GetEvent',
            'cloudphoto'
        );
    }

    /**
     * @param string $eventId
     *
     * @return $this
     */
    public function setEventId($eventId)
    {
        $this->requestParameters['EventId'] = $eventId;
        $this->queryParameters['EventId'] = $eventId;

        return $this;
    }

    /**
     * @param string $libraryId
     *
     * @return $this
     */
    public function setLibraryId($libraryId)
    {
        $this->requestParameters['LibraryId'] = $libraryId;
        $this->queryParameters['LibraryId'] = $libraryId;

        return $this;
    }

    /**
     * @param string $storeName
     *
     * @return $this
     */
    public function setStoreName($storeName)
    {
        $this->requestParameters['StoreName'] = $storeName;
        $this->queryParameters['StoreName'] = $storeName;

        return $this;
    }
}
