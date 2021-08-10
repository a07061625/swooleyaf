<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getReportId()
 * @method $this withReportId($value)
 * @method string getLang()
 */
class DescribeDiagnoseReport extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/diagnosis/instances/[InstanceId]/reports/[ReportId]';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLang($value)
    {
        $this->data['Lang'] = $value;
        $this->options['query']['lang'] = $value;

        return $this;
    }
}
