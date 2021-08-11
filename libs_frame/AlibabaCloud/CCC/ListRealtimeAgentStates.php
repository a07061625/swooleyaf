<?php

namespace AlibabaCloud\CCC;

/**
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getAgentIdList()
 * @method string getSkillGroupId()
 * @method $this withSkillGroupId($value)
 * @method string getAgentName()
 * @method $this withAgentName($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getStateList()
 */
class ListRealtimeAgentStates extends Rpc
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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStateList($value)
    {
        $this->data['StateList'] = $value;
        $this->options['form_params']['StateList'] = $value;

        return $this;
    }
}
