<?php

namespace AlibabaCloud\BssOpenApi;

/**
 * @method array getUnitEntityList()
 */
class ModifyCostUnit extends Rpc
{
    /**
     * @return $this
     */
    public function withUnitEntityList(array $unitEntityList)
    {
        $this->data['UnitEntityList'] = $unitEntityList;
        foreach ($unitEntityList as $depth1 => $depth1Value) {
            if (isset($depth1Value['NewUnitName'])) {
                $this->options['query']['UnitEntityList.' . ($depth1 + 1) . '.NewUnitName'] = $depth1Value['NewUnitName'];
            }
            if (isset($depth1Value['UnitId'])) {
                $this->options['query']['UnitEntityList.' . ($depth1 + 1) . '.UnitId'] = $depth1Value['UnitId'];
            }
            if (isset($depth1Value['OwnerUid'])) {
                $this->options['query']['UnitEntityList.' . ($depth1 + 1) . '.OwnerUid'] = $depth1Value['OwnerUid'];
            }
        }

        return $this;
    }
}
