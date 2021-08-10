<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getInstanceId()
 * @method string getPageNo()
 * @method string getPageSize()
 * @method string getEntityName()
 * @method string getEntityRelationNumber()
 */
class GetEntityRouteList extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId($value)
    {
        $this->data['InstanceId'] = $value;
        $this->options['form_params']['InstanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNo($value)
    {
        $this->data['PageNo'] = $value;
        $this->options['form_params']['PageNo'] = $value;

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
    public function withEntityName($value)
    {
        $this->data['EntityName'] = $value;
        $this->options['form_params']['EntityName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEntityRelationNumber($value)
    {
        $this->data['EntityRelationNumber'] = $value;
        $this->options['form_params']['EntityRelationNumber'] = $value;

        return $this;
    }
}
