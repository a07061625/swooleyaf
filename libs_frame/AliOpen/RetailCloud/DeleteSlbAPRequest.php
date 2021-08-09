<?php

namespace AliOpen\RetailCloud;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteSlbAP
 *
 * @method string getSlbAPId()
 */
class DeleteSlbAPRequest extends RpcAcsRequest
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
        parent::__construct('retailcloud', '2018-03-13', 'DeleteSlbAP', 'retailcloud');
    }

    /**
     * @param string $slbAPId
     *
     * @return $this
     */
    public function setSlbAPId($slbAPId)
    {
        $this->requestParameters['SlbAPId'] = $slbAPId;
        $this->queryParameters['SlbAPId'] = $slbAPId;

        return $this;
    }
}
