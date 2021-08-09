<?php

namespace AliOpen\CCC;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifyPrivacyNumberCallDetail
 *
 * @method string getCallId()
 * @method string getContactId()
 * @method string getInstanceId()
 */
class ModifyPrivacyNumberCallDetailRequest extends RpcAcsRequest
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
            'ModifyPrivacyNumberCallDetail',
            'CCC'
        );
    }

    /**
     * @param string $callId
     *
     * @return $this
     */
    public function setCallId($callId)
    {
        $this->requestParameters['CallId'] = $callId;
        $this->queryParameters['CallId'] = $callId;

        return $this;
    }

    /**
     * @param string $contactId
     *
     * @return $this
     */
    public function setContactId($contactId)
    {
        $this->requestParameters['ContactId'] = $contactId;
        $this->queryParameters['ContactId'] = $contactId;

        return $this;
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
}
