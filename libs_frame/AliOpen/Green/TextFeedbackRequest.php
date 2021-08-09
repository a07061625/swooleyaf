<?php

namespace AliOpen\Green;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of TextFeedback
 *
 * @method string getClientInfo()
 */
class TextFeedbackRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/green/text/feedback';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Green', '2018-05-09', 'TextFeedback', 'green');
    }

    /**
     * @param string $clientInfo
     *
     * @return $this
     */
    public function setClientInfo($clientInfo)
    {
        $this->requestParameters['ClientInfo'] = $clientInfo;
        $this->queryParameters['ClientInfo'] = $clientInfo;

        return $this;
    }
}
