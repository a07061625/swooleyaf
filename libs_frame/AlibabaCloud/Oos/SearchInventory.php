<?php

namespace AlibabaCloud\Oos;

/**
 * @method array getAggregator()
 * @method array getFilter()
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 */
class SearchInventory extends Rpc
{
    /**
     * @return $this
     */
    public function withAggregator(array $aggregator)
    {
        $this->data['Aggregator'] = $aggregator;
        foreach ($aggregator as $i => $iValue) {
            $this->options['query']['Aggregator.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

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
