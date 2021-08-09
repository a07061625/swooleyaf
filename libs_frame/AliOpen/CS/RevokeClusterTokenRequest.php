<?php
namespace AliOpen\CS;

use AliOpen\Core\RoaAcsRequest;

/**
 * 
 *
 * Request of RevokeClusterToken
 *
 * @method string getToken()
 */
class RevokeClusterTokenRequest extends RoaAcsRequest
{

    /**
     * @var string
     */
    protected $uriPattern = '/token/[Token]/revoke';

    /**
     * @var string
     */
    protected $method = 'DELETE';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'CS',
            '2015-12-15',
            'RevokeClusterToken'
        );
    }

    /**
     * @param string $token
     *
     * @return $this
     */
    public function setToken($token)
    {
        $this->requestParameters['Token'] = $token;
        $this->pathParameters['Token'] = $token;

        return $this;
    }
}
