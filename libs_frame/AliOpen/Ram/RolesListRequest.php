<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ListRoles
 * @method string getMarker()
 * @method string getMaxItems()
 */
class RolesListRequest extends RpcAcsRequest
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
        parent::__construct('Ram', '2015-05-01', 'ListRoles', 'ram');
    }

    /**
     * @param string $marker
     * @return $this
     */
    public function setMarker($marker)
    {
        $this->requestParameters['Marker'] = $marker;
        $this->queryParameters['Marker'] = $marker;

        return $this;
    }

    /**
     * @param string $maxItems
     * @return $this
     */
    public function setMaxItems($maxItems)
    {
        $this->requestParameters['MaxItems'] = $maxItems;
        $this->queryParameters['MaxItems'] = $maxItems;

        return $this;
    }
}
