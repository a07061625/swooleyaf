<?php

namespace AlibabaCloud\DomainIntl;

/**
 * @method string getContactType()
 * @method $this withContactType($value)
 * @method string getUserClientIp()
 * @method $this withUserClientIp($value)
 * @method string getRegistrantProfileId()
 * @method $this withRegistrantProfileId($value)
 * @method array getDomainName()
 * @method string getAddTransferLock()
 * @method $this withAddTransferLock($value)
 * @method string getLang()
 * @method $this withLang($value)
 */
class SaveBatchTaskForUpdatingContactInfo extends Rpc
{
    /**
     * @return $this
     */
    public function withDomainName(array $domainName)
    {
        $this->data['DomainName'] = $domainName;
        foreach ($domainName as $i => $iValue) {
            $this->options['query']['DomainName.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
