<?php

namespace AliOpen\CCC;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeletePhoneTags
 *
 * @method string getInstanceId()
 * @method array getPhoneNumberLists()
 */
class DeletePhoneTagsRequest extends RpcAcsRequest
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
            'DeletePhoneTags',
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
    public function setPhoneNumberLists(array $phoneNumberList)
    {
        $this->requestParameters['PhoneNumberLists'] = $phoneNumberList;
        foreach ($phoneNumberList as $i => $iValue) {
            $this->queryParameters['PhoneNumberList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
