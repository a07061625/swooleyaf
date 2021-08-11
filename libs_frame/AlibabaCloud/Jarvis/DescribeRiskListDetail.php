<?php

namespace AlibabaCloud\Jarvis;

/**
 * @method string getRiskType()
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getPageSize()
 * @method string getQueryProduct()
 * @method string getCurrentPage()
 * @method string getRiskDescribe()
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getSrcUid()
 * @method string getSourceCode()
 * @method string getQueryRegionId()
 * @method string getStatus()
 */
class DescribeRiskListDetail extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRiskType($value)
    {
        $this->data['RiskType'] = $value;
        $this->options['query']['riskType'] = $value;

        return $this;
    }

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
    public function withQueryProduct($value)
    {
        $this->data['QueryProduct'] = $value;
        $this->options['query']['queryProduct'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRiskDescribe($value)
    {
        $this->data['RiskDescribe'] = $value;
        $this->options['query']['riskDescribe'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSrcUid($value)
    {
        $this->data['SrcUid'] = $value;
        $this->options['query']['srcUid'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceCode($value)
    {
        $this->data['SourceCode'] = $value;
        $this->options['query']['sourceCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withQueryRegionId($value)
    {
        $this->data['QueryRegionId'] = $value;
        $this->options['query']['queryRegionId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStatus($value)
    {
        $this->data['Status'] = $value;
        $this->options['query']['status'] = $value;

        return $this;
    }
}
