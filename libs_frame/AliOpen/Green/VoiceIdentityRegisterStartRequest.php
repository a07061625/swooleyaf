<?php
namespace AliOpen\Green;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of VoiceIdentityStartRegister
 * @method string getClientInfo()
 */
class VoiceIdentityRegisterStartRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/green/voice/auth/start/register';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Green', '2018-05-09', 'VoiceIdentityStartRegister', 'green');
    }

    /**
     * @param string $clientInfo
     * @return $this
     */
    public function setClientInfo($clientInfo)
    {
        $this->requestParameters['ClientInfo'] = $clientInfo;
        $this->queryParameters['ClientInfo'] = $clientInfo;

        return $this;
    }
}
