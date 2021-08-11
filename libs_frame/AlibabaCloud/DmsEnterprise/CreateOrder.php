<?php

namespace AlibabaCloud\DmsEnterprise;

/**
 * @method string getTid()
 * @method $this withTid($value)
 * @method string getPluginType()
 * @method $this withPluginType($value)
 * @method string getAttachmentKey()
 * @method $this withAttachmentKey($value)
 * @method string getComment()
 * @method $this withComment($value)
 * @method string getPluginParam()
 * @method string getRelatedUserList()
 * @method $this withRelatedUserList($value)
 */
class CreateOrder extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPluginParam($value)
    {
        $this->data['PluginParam'] = $value;
        $this->options['form_params']['PluginParam'] = $value;

        return $this;
    }
}
