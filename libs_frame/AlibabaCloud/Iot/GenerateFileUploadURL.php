<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getFileSuffix()
 * @method $this withFileSuffix($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getFileName()
 * @method $this withFileName($value)
 * @method string getBizCode()
 * @method $this withBizCode($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class GenerateFileUploadURL extends Rpc
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
