<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getCorpId()
 * @method string getGbId()
 */
class DeleteDevice extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCorpId($value)
    {
        $this->data['CorpId'] = $value;
        $this->options['form_params']['CorpId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGbId($value)
    {
        $this->data['GbId'] = $value;
        $this->options['form_params']['GbId'] = $value;

        return $this;
    }
}
