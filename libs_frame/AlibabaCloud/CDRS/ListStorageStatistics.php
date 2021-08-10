<?php

namespace AlibabaCloud\CDRS;

/**
 * @method string getCorpId()
 */
class ListStorageStatistics extends Rpc
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
