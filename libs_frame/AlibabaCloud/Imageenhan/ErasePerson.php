<?php

namespace AlibabaCloud\Imageenhan;

/**
 * @method string getImageURL()
 * @method string getUserMask()
 */
class ErasePerson extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImageURL($value)
    {
        $this->data['ImageURL'] = $value;
        $this->options['form_params']['ImageURL'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserMask($value)
    {
        $this->data['UserMask'] = $value;
        $this->options['form_params']['UserMask'] = $value;

        return $this;
    }
}
