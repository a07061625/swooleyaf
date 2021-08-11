<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getBuildNum()
 * @method string getUserPk()
 * @method string getOrgId()
 * @method $this withOrgId($value)
 * @method string getPipelineId()
 * @method $this withPipelineId($value)
 */
class GetPipelineInstanceBuildNumberStatus extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBuildNum($value)
    {
        $this->data['BuildNum'] = $value;
        $this->options['form_params']['BuildNum'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserPk($value)
    {
        $this->data['UserPk'] = $value;
        $this->options['form_params']['UserPk'] = $value;

        return $this;
    }
}
