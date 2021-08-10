<?php

namespace AlibabaCloud\CDRS;

/**
 * @method string getCorpId()
 * @method string getBackCategory()
 */
class ListStructureStatistics extends Rpc
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
    public function withBackCategory($value)
    {
        $this->data['BackCategory'] = $value;
        $this->options['form_params']['BackCategory'] = $value;

        return $this;
    }
}
