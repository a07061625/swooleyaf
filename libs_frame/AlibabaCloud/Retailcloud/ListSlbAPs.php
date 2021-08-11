<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method array getProtocolList()
 * @method string getSlbId()
 * @method $this withSlbId($value)
 * @method string getAppId()
 * @method $this withAppId($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getEnvId()
 * @method $this withEnvId($value)
 * @method string getNetworkMode()
 * @method $this withNetworkMode($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 */
class ListSlbAPs extends Rpc
{
    /**
     * @return $this
     */
    public function withProtocolList(array $protocolList)
    {
        $this->data['ProtocolList'] = $protocolList;
        foreach ($protocolList as $i => $iValue) {
            $this->options['form_params']['ProtocolList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
