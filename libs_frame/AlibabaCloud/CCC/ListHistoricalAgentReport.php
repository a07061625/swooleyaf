<?php

namespace AlibabaCloud\CCC;

/**
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getStopTime()
 * @method $this withStopTime($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getAgentIdList()
 * @method string getPageSize()
 * @method $this withPageSize($value)
 */
class ListHistoricalAgentReport extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAgentIdList($value)
    {
        $this->data['AgentIdList'] = $value;
        $this->options['form_params']['AgentIdList'] = $value;

        return $this;
    }
}
