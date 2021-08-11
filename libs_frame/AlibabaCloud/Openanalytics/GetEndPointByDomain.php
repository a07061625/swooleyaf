<?php

namespace AlibabaCloud\Openanalytics;

/**
 * @method string getUserID()
 * @method string getDomainURL()
 */
class GetEndPointByDomain extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserID($value)
    {
        $this->data['UserID'] = $value;
        $this->options['form_params']['UserID'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDomainURL($value)
    {
        $this->data['DomainURL'] = $value;
        $this->options['form_params']['DomainURL'] = $value;

        return $this;
    }
}
