<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getCorpId()
 * @method string getCorpGroupId()
 */
class UnbindCorpGroup extends Rpc
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
    public function withCorpGroupId($value)
    {
        $this->data['CorpGroupId'] = $value;
        $this->options['form_params']['CorpGroupId'] = $value;

        return $this;
    }
}
