<?php

namespace AlibabaCloud\Dg;

/**
 * @method string getUserOS()
 * @method string getDgVersion()
 */
class DownloadGatewayProgram extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserOS($value)
    {
        $this->data['UserOS'] = $value;
        $this->options['form_params']['UserOS'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDgVersion($value)
    {
        $this->data['DgVersion'] = $value;
        $this->options['form_params']['DgVersion'] = $value;

        return $this;
    }
}
