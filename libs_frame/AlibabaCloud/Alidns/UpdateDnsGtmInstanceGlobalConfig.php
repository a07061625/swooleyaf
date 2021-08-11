<?php

namespace AlibabaCloud\Alidns;

/**
 * @method string getAlertGroup()
 * @method $this withAlertGroup($value)
 * @method string getCnameType()
 * @method $this withCnameType($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method array getAlertConfig()
 * @method string getPublicCnameMode()
 * @method $this withPublicCnameMode($value)
 * @method string getPublicUserDomainName()
 * @method $this withPublicUserDomainName($value)
 * @method string getTtl()
 * @method $this withTtl($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getInstanceName()
 * @method $this withInstanceName($value)
 * @method string getUserClientIp()
 * @method $this withUserClientIp($value)
 * @method string getPublicZoneName()
 * @method $this withPublicZoneName($value)
 */
class UpdateDnsGtmInstanceGlobalConfig extends Rpc
{
    /**
     * @return $this
     */
    public function withAlertConfig(array $alertConfig)
    {
        $this->data['AlertConfig'] = $alertConfig;
        foreach ($alertConfig as $depth1 => $depth1Value) {
            if (isset($depth1Value['SmsNotice'])) {
                $this->options['query']['AlertConfig.' . ($depth1 + 1) . '.SmsNotice'] = $depth1Value['SmsNotice'];
            }
            if (isset($depth1Value['NoticeType'])) {
                $this->options['query']['AlertConfig.' . ($depth1 + 1) . '.NoticeType'] = $depth1Value['NoticeType'];
            }
            if (isset($depth1Value['EmailNotice'])) {
                $this->options['query']['AlertConfig.' . ($depth1 + 1) . '.EmailNotice'] = $depth1Value['EmailNotice'];
            }
        }

        return $this;
    }
}
