<?php

namespace AliOpen\Cms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteContact
 *
 * @method string getContactName()
 */
class DeleteContactRequest extends RpcAcsRequest
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
            'DeleteContact',
            'cms'
        );
    }

    /**
     * @param string $contactName
     *
     * @return $this
     */
    public function setContactName($contactName)
    {
        $this->requestParameters['ContactName'] = $contactName;
        $this->queryParameters['ContactName'] = $contactName;

        return $this;
    }
}
