<?php

namespace AliOpen\Green;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of ListSimilarityLibraries
 *
 * @method string getClientInfo()
 */
class SimilarityLibrariesListRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/green/similarity/library/list';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Green', '2018-05-09', 'ListSimilarityLibraries', 'green');
    }

    /**
     * @param string $clientInfo
     *
     * @return $this
     */
    public function setClientInfo($clientInfo)
    {
        $this->requestParameters['ClientInfo'] = $clientInfo;
        $this->queryParameters['ClientInfo'] = $clientInfo;

        return $this;
    }
}
