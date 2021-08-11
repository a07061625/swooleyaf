<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getTableGuid()
 * @method $this withTableGuid($value)
 * @method string getContent()
 */
class UpdateMetaTableIntroWiki extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withContent($value)
    {
        $this->data['Content'] = $value;
        $this->options['form_params']['Content'] = $value;

        return $this;
    }
}
