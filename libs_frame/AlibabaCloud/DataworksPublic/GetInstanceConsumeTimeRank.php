<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getBizdate()
 * @method string getProjectId()
 */
class GetInstanceConsumeTimeRank extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizdate($value)
    {
        $this->data['Bizdate'] = $value;
        $this->options['form_params']['Bizdate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectId($value)
    {
        $this->data['ProjectId'] = $value;
        $this->options['form_params']['ProjectId'] = $value;

        return $this;
    }
}
