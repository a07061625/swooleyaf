<?php

namespace AliOpen\CCC;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of PickLocalNumber
 *
 * @method string getInstanceId()
 * @method array getCandidateNumbers()
 * @method string getCalleeNumber()
 */
class PickLocalNumberRequest extends RpcAcsRequest
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
            'CCC',
            '2017-07-05',
            'PickLocalNumber',
            'CCC'
        );
    }

    /**
     * @param string $instanceId
     *
     * @return $this
     */
    public function setInstanceId($instanceId)
    {
        $this->requestParameters['InstanceId'] = $instanceId;
        $this->queryParameters['InstanceId'] = $instanceId;

        return $this;
    }

    /**
     * @return $this
     */
    public function setCandidateNumbers(array $candidateNumber)
    {
        $this->requestParameters['CandidateNumbers'] = $candidateNumber;
        foreach ($candidateNumber as $i => $iValue) {
            $this->queryParameters['CandidateNumber.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $calleeNumber
     *
     * @return $this
     */
    public function setCalleeNumber($calleeNumber)
    {
        $this->requestParameters['CalleeNumber'] = $calleeNumber;
        $this->queryParameters['CalleeNumber'] = $calleeNumber;

        return $this;
    }
}
