<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getVersionState()
 * @method $this withVersionState($value)
 * @method string getDriverId()
 * @method $this withDriverId($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDriverVersion()
 * @method $this withDriverVersion($value)
 * @method string getCurrentPage()
 * @method $this withCurrentPage($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class QueryEdgeDriverVersion extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiProduct($value)
    {
        $this->data['ApiProduct'] = $value;
        $this->options['form_params']['ApiProduct'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiRevision($value)
    {
        $this->data['ApiRevision'] = $value;
        $this->options['form_params']['ApiRevision'] = $value;

        return $this;
    }
}
