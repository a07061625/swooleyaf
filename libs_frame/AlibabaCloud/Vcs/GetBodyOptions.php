<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getCorpId()
 */
class GetBodyOptions extends Rpc
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
}
