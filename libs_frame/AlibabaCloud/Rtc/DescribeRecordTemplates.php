<?php

namespace AlibabaCloud\Rtc;

/**
 * @method array getTemplateIds()
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getAppId()
 * @method $this withAppId($value)
 */
class DescribeRecordTemplates extends Rpc
{
    /**
     * @return $this
     */
    public function withTemplateIds(array $templateIds)
    {
        $this->data['TemplateIds'] = $templateIds;
        foreach ($templateIds as $i => $iValue) {
            $this->options['query']['TemplateIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
