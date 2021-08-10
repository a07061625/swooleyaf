<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getBlockchain()
 * @method string getAccountPubKey()
 * @method string getUploadReq()
 * @method string getAccountRecoverPubKey()
 * @method string getAccount()
 */
class ApplyBlockchain extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBlockchain($value)
    {
        $this->data['Blockchain'] = $value;
        $this->options['form_params']['Blockchain'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccountPubKey($value)
    {
        $this->data['AccountPubKey'] = $value;
        $this->options['form_params']['AccountPubKey'] = $value;

        return $this;
    }

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
    public function withAccountRecoverPubKey($value)
    {
        $this->data['AccountRecoverPubKey'] = $value;
        $this->options['form_params']['AccountRecoverPubKey'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccount($value)
    {
        $this->data['Account'] = $value;
        $this->options['form_params']['Account'] = $value;

        return $this;
    }
}
