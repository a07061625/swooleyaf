<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getProjectId()
 */
class ListSuccessInstanceAmount extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectId($value)
    {
        $this->data['ProjectId'] = $value;
        $this->options['form_params']['ProjectId'] = $value;

        return $this;
    }
}
