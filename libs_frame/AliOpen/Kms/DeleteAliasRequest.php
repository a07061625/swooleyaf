<?php

namespace AliOpen\Kms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteAlias
 *
 * @method string getAliasName()
 */
class DeleteAliasRequest extends RpcAcsRequest
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
        parent::__construct('Kms', '2016-01-20', 'DeleteAlias', 'kms');
    }

    /**
     * @param string $aliasName
     *
     * @return $this
     */
    public function setAliasName($aliasName)
    {
        $this->requestParameters['AliasName'] = $aliasName;
        $this->queryParameters['AliasName'] = $aliasName;

        return $this;
    }
}
