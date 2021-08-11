<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getPageNumber()
 * @method string getPageSize()
 * @method string getDevEui()
 * @method string getBase64EncodedMacPayload()
 * @method string getLogMillis()
 */
class ListNodeTransferPacketPaths extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNumber($value)
    {
        $this->data['PageNumber'] = $value;
        $this->options['form_params']['PageNumber'] = $value;

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
    public function withDevEui($value)
    {
        $this->data['DevEui'] = $value;
        $this->options['form_params']['DevEui'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBase64EncodedMacPayload($value)
    {
        $this->data['Base64EncodedMacPayload'] = $value;
        $this->options['form_params']['Base64EncodedMacPayload'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLogMillis($value)
    {
        $this->data['LogMillis'] = $value;
        $this->options['form_params']['LogMillis'] = $value;

        return $this;
    }
}
