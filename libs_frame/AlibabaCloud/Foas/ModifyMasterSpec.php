<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getClusterId()
 * @method string getMasterTargetModel()
 */
class ModifyMasterSpec extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/clusters/[clusterId]/specification';

    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClusterId($value)
    {
        $this->data['ClusterId'] = $value;
        $this->pathParameters['clusterId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMasterTargetModel($value)
    {
        $this->data['MasterTargetModel'] = $value;
        $this->options['form_params']['masterTargetModel'] = $value;

        return $this;
    }
}
