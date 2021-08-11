<?php

namespace AlibabaCloud\Smartag;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getRecoveredDNS()
 * @method array getAppDNS()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getSmartAGId()
 * @method $this withSmartAGId($value)
 */
class ModifyClientUserDNS extends Rpc
{
    /**
     * @return $this
     */
    public function withRecoveredDNS(array $recoveredDNS)
    {
        $this->data['RecoveredDNS'] = $recoveredDNS;
        foreach ($recoveredDNS as $i => $iValue) {
            $this->options['query']['RecoveredDNS.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withAppDNS(array $appDNS)
    {
        $this->data['AppDNS'] = $appDNS;
        foreach ($appDNS as $i => $iValue) {
            $this->options['query']['AppDNS.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
