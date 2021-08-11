<?php

namespace AlibabaCloud\BssOpenApi;

/**
 * @method array getUnitEntityList()
 */
class CreateCostUnit extends Rpc
{
    /**
     * @return $this
     */
    public function withUnitEntityList(array $unitEntityList)
    {
        $this->data['UnitEntityList'] = $unitEntityList;
        foreach ($unitEntityList as $depth1 => $depth1Value) {
            if (isset($depth1Value['UnitName'])) {
                $this->options['query']['UnitEntityList.' . ($depth1 + 1) . '.UnitName'] = $depth1Value['UnitName'];
            }
            if (isset($depth1Value['ParentUnitId'])) {
                $this->options['query']['UnitEntityList.' . ($depth1 + 1) . '.ParentUnitId'] = $depth1Value['ParentUnitId'];
            }
            if (isset($depth1Value['OwnerUid'])) {
                $this->options['query']['UnitEntityList.' . ($depth1 + 1) . '.OwnerUid'] = $depth1Value['OwnerUid'];
            }
        }

        return $this;
    }
}
