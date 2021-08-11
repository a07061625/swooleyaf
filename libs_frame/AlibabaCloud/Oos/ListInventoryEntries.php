<?php

namespace AlibabaCloud\Oos;

/**
 * @method array getFilter()
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 * @method string getTypeName()
 * @method $this withTypeName($value)
 */
class ListInventoryEntries extends Rpc
{
    /**
     * @return $this
     */
    public function withFilter(array $filter)
    {
        $this->data['Filter'] = $filter;
        foreach ($filter as $depth1 => $depth1Value) {
            if (isset($depth1Value['Name'])) {
                $this->options['query']['Filter.' . ($depth1 + 1) . '.Name'] = $depth1Value['Name'];
            }
            foreach ($depth1Value['Value'] as $i => $iValue) {
                $this->options['query']['Filter.' . ($depth1 + 1) . '.Value.' . ($i + 1)] = $iValue;
            }
            if (isset($depth1Value['Operator'])) {
                $this->options['query']['Filter.' . ($depth1 + 1) . '.Operator'] = $depth1Value['Operator'];
            }
        }

        return $this;
    }
}
