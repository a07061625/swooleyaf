<?php

namespace AliOpen\Imm;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of RefreshWebofficeToken
 *
 * @method string getProject()
 * @method string getAccessToken()
 * @method string getRefreshToken()
 */
class RefreshWebofficeTokenRequest extends RpcAcsRequest
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
        parent::__construct('imm', '2017-09-06', 'RefreshWebofficeToken', 'imm');
    }

    /**
     * @param string $project
     *
     * @return $this
     */
    public function setProject($project)
    {
        $this->requestParameters['Project'] = $project;
        $this->queryParameters['Project'] = $project;

        return $this;
    }

    /**
     * @param string $accessToken
     *
     * @return $this
     */
    public function setAccessToken($accessToken)
    {
        $this->requestParameters['AccessToken'] = $accessToken;
        $this->queryParameters['AccessToken'] = $accessToken;

        return $this;
    }

    /**
     * @param string $refreshToken
     *
     * @return $this
     */
    public function setRefreshToken($refreshToken)
    {
        $this->requestParameters['RefreshToken'] = $refreshToken;
        $this->queryParameters['RefreshToken'] = $refreshToken;

        return $this;
    }
}
