<?php

namespace AlibabaCloud\TeambitionAliyun;

/**
 * @method string getUserPk()
 */
class CheckAliyunUserExists extends Rpc
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
