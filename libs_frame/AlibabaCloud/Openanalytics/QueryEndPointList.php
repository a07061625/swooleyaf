<?php

namespace AlibabaCloud\Openanalytics;

/**
 * @method string getUserID()
 */
class QueryEndPointList extends Rpc
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
}
