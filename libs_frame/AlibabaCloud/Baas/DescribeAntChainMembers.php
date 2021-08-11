<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getCurrent()
 * @method string getPageSize()
 * @method string getConsortiumId()
 */
class DescribeAntChainMembers extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCurrent($value)
    {
        $this->data['Current'] = $value;
        $this->options['form_params']['Current'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['form_params']['PageSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withConsortiumId($value)
    {
        $this->data['ConsortiumId'] = $value;
        $this->options['form_params']['ConsortiumId'] = $value;

        return $this;
    }
}
