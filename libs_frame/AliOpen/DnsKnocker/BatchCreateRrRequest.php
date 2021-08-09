<?php

namespace AliOpen\DnsKnocker;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of BatchCreateRr
 *
 * @method string getAccessID()
 * @method string getAccessSecret()
 * @method string getResourceRecords()
 * @method string getLine()
 * @method string getZoneName()
 * @method string getTransactionId()
 * @method string getGroup()
 */
class BatchCreateRrRequest extends RpcAcsRequest
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
        parent::__construct('DnsKnocker', '2019-09-10', 'BatchCreateRr', 'dns_knocker');
    }

    /**
     * @param string $accessID
     *
     * @return $this
     */
    public function setAccessID($accessID)
    {
        $this->requestParameters['AccessID'] = $accessID;
        $this->queryParameters['AccessID'] = $accessID;

        return $this;
    }

    /**
     * @param string $accessSecret
     *
     * @return $this
     */
    public function setAccessSecret($accessSecret)
    {
        $this->requestParameters['AccessSecret'] = $accessSecret;
        $this->queryParameters['AccessSecret'] = $accessSecret;

        return $this;
    }

    /**
     * @param string $resourceRecords
     *
     * @return $this
     */
    public function setResourceRecords($resourceRecords)
    {
        $this->requestParameters['ResourceRecords'] = $resourceRecords;
        $this->queryParameters['ResourceRecords'] = $resourceRecords;

        return $this;
    }

    /**
     * @param string $line
     *
     * @return $this
     */
    public function setLine($line)
    {
        $this->requestParameters['Line'] = $line;
        $this->queryParameters['Line'] = $line;

        return $this;
    }

    /**
     * @param string $zoneName
     *
     * @return $this
     */
    public function setZoneName($zoneName)
    {
        $this->requestParameters['ZoneName'] = $zoneName;
        $this->queryParameters['ZoneName'] = $zoneName;

        return $this;
    }

    /**
     * @param string $transactionId
     *
     * @return $this
     */
    public function setTransactionId($transactionId)
    {
        $this->requestParameters['TransactionId'] = $transactionId;
        $this->queryParameters['TransactionId'] = $transactionId;

        return $this;
    }

    /**
     * @param string $group
     *
     * @return $this
     */
    public function setGroup($group)
    {
        $this->requestParameters['Group'] = $group;
        $this->queryParameters['Group'] = $group;

        return $this;
    }
}
