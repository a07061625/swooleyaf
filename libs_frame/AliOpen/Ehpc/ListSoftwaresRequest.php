<?php
namespace AliOpen\Ehpc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ListSoftwares
 * @method string getEhpcVersion()
 */
class ListSoftwaresRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('EHPC', '2018-04-12', 'ListSoftwares', 'ehs');
    }

    /**
     * @param string $ehpcVersion
     * @return $this
     */
    public function setEhpcVersion($ehpcVersion)
    {
        $this->requestParameters['EhpcVersion'] = $ehpcVersion;
        $this->queryParameters['EhpcVersion'] = $ehpcVersion;

        return $this;
    }
}
