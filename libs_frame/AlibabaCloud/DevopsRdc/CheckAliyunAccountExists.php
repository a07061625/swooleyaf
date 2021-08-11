<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getUserPk()
 */
class CheckAliyunAccountExists extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserPk($value)
    {
        $this->data['UserPk'] = $value;
        $this->options['form_params']['UserPk'] = $value;

        return $this;
    }
}
