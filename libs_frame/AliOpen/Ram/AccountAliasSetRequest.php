<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SetAccountAlias
 * @method string getAccountAlias()
 */
class AccountAliasSetRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $requestScheme = 'https';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Ram', '2015-05-01', 'SetAccountAlias', 'ram');
    }

    /**
     * @param string $accountAlias
     * @return $this
     */
    public function setAccountAlias($accountAlias)
    {
        $this->requestParameters['AccountAlias'] = $accountAlias;
        $this->queryParameters['AccountAlias'] = $accountAlias;

        return $this;
    }
}
