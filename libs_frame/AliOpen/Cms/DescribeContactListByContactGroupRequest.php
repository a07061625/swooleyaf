<?php

namespace AliOpen\Cms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeContactListByContactGroup
 *
 * @method string getContactGroupName()
 */
class DescribeContactListByContactGroupRequest extends RpcAcsRequest
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
            'Cms',
            '2019-01-01',
            'DescribeContactListByContactGroup',
            'cms'
        );
    }

    /**
     * @param string $contactGroupName
     *
     * @return $this
     */
    public function setContactGroupName($contactGroupName)
    {
        $this->requestParameters['ContactGroupName'] = $contactGroupName;
        $this->queryParameters['ContactGroupName'] = $contactGroupName;

        return $this;
    }
}
