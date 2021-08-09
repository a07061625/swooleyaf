<?php

namespace AliOpen\Aegis;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteLogQuery
 *
 * @method string getSourceIp()
 * @method string getQueryName()
 */
class LogQueryDeleteRequest extends RpcAcsRequest
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
        parent::__construct('aegis', '2016-11-11', 'DeleteLogQuery', 'vipaegis');
    }

    /**
     * @param string $sourceIp
     *
     * @return $this
     */
    public function setSourceIp($sourceIp)
    {
        $this->requestParameters['SourceIp'] = $sourceIp;
        $this->queryParameters['SourceIp'] = $sourceIp;

        return $this;
    }

    /**
     * @param string $queryName
     *
     * @return $this
     */
    public function setQueryName($queryName)
    {
        $this->requestParameters['QueryName'] = $queryName;
        $this->queryParameters['QueryName'] = $queryName;

        return $this;
    }
}
