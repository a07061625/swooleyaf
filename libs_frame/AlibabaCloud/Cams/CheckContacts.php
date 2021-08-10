<?php

namespace AlibabaCloud\Cams;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getChannelType()
 * @method string getFrom()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getContacts()
 */
class CheckContacts extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withChannelType($value)
    {
        $this->data['ChannelType'] = $value;
        $this->options['form_params']['ChannelType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFrom($value)
    {
        $this->data['From'] = $value;
        $this->options['form_params']['From'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withContacts($value)
    {
        $this->data['Contacts'] = $value;
        $this->options['form_params']['Contacts'] = $value;

        return $this;
    }
}
