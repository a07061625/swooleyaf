<?php

namespace AlibabaCloud\Jarvis;

/**
 * @method string getSrcIP()
 * @method $this withSrcIP($value)
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getPageSize()
 * @method string getCurrentPage()
 * @method string getDstIP()
 * @method $this withDstIP($value)
 * @method string getRegion()
 * @method $this withRegion($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getSourceCode()
 * @method $this withSourceCode($value)
 */
class DescribeResetRecordList extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['query']['pageSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCurrentPage($value)
    {
        $this->data['CurrentPage'] = $value;
        $this->options['query']['currentPage'] = $value;

        return $this;
    }
}
