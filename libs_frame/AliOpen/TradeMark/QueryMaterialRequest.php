<?php

namespace AliOpen\TradeMark;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of QueryMaterial
 *
 * @method string getId()
 */
class QueryMaterialRequest extends RpcAcsRequest
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
        parent::__construct('Trademark', '2018-07-24', 'QueryMaterial', 'trademark');
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->requestParameters['Id'] = $id;
        $this->queryParameters['Id'] = $id;

        return $this;
    }
}
