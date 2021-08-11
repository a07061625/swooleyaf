<?php

namespace AlibabaCloud\Aegis;

/**
 * @method string getWarnLevel()
 * @method $this withWarnLevel($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getRemark()
 * @method string getCurrentPage()
 * @method $this withCurrentPage($value)
 */
class DescribeJoinRuleList extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRemark($value)
    {
        $this->data['Remark'] = $value;
        $this->options['query']['remark'] = $value;

        return $this;
    }
}
