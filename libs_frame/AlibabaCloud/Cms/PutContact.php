<?php

namespace AlibabaCloud\Cms;

/**
 * @method string getChannelsDingWebHook()
 * @method string getContactName()
 * @method $this withContactName($value)
 * @method string getChannelsMail()
 * @method string getChannelsAliIM()
 * @method string getDescribe()
 * @method $this withDescribe($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getChannelsSMS()
 */
class PutContact extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withChannelsDingWebHook($value)
    {
        $this->data['ChannelsDingWebHook'] = $value;
        $this->options['query']['Channels.DingWebHook'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withChannelsMail($value)
    {
        $this->data['ChannelsMail'] = $value;
        $this->options['query']['Channels.Mail'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withChannelsAliIM($value)
    {
        $this->data['ChannelsAliIM'] = $value;
        $this->options['query']['Channels.AliIM'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withChannelsSMS($value)
    {
        $this->data['ChannelsSMS'] = $value;
        $this->options['query']['Channels.SMS'] = $value;

        return $this;
    }
}
