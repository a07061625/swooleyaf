<?php

namespace AlibabaCloud\Alidns;

/**
 * @method string getGroupId()
 * @method $this withGroupId($value)
 * @method string getStartDate()
 * @method $this withStartDate($value)
 * @method string getType()
 * @method $this withType($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getEndDate()
 * @method string getUserClientIp()
 * @method $this withUserClientIp($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getKeyWord()
 * @method $this withKeyWord($value)
 */
class DescribeDomainLogs extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndDate($value)
    {
        $this->data['EndDate'] = $value;
        $this->options['query']['endDate'] = $value;

        return $this;
    }
}
