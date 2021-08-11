<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getUploadReq()
 * @method string getBizid()
 * @method string getConsortiumId()
 */
class ApplyAntChain extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUploadReq($value)
    {
        $this->data['UploadReq'] = $value;
        $this->options['form_params']['UploadReq'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizid($value)
    {
        $this->data['Bizid'] = $value;
        $this->options['form_params']['Bizid'] = $value;

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
