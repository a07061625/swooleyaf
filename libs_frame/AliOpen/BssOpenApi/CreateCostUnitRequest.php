<?php

namespace AliOpen\BssOpenApi;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateCostUnit
 *
 * @method array getUnitEntityLists()
 */
class CreateCostUnitRequest extends RpcAcsRequest
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
        parent::__construct('BssOpenApi', '2017-12-14', 'CreateCostUnit', 'BssOpenApi');
    }

    /**
     * @return $this
     */
    public function setUnitEntityLists(array $unitEntityList)
    {
        $this->requestParameters['UnitEntityLists'] = $unitEntityList;
        foreach ($unitEntityList as $depth1 => $depth1Value) {
            $this->queryParameters['UnitEntityList.' . ($depth1 + 1) . '.UnitName'] = $depth1Value['UnitName'];
            $this->queryParameters['UnitEntityList.' . ($depth1 + 1) . '.ParentUnitId'] = $depth1Value['ParentUnitId'];
            $this->queryParameters['UnitEntityList.' . ($depth1 + 1) . '.OwnerUid'] = $depth1Value['OwnerUid'];
        }

        return $this;
    }
}
