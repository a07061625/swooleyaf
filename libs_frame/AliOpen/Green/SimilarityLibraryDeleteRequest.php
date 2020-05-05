<?php
namespace AliOpen\Green;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of DeleteSimilarityLibrary
 * @method string getClientInfo()
 */
class SimilarityLibraryDeleteRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/green/similarity/library/delete';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Green', '2018-05-09', 'DeleteSimilarityLibrary', 'green');
    }

    /**
     * @param string $clientInfo
     * @return $this
     */
    public function setClientInfo($clientInfo)
    {
        $this->requestParameters['ClientInfo'] = $clientInfo;
        $this->queryParameters['ClientInfo'] = $clientInfo;

        return $this;
    }
}
