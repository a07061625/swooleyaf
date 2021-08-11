<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getDomainName()
 * @method string getAppGroupIdentity()
 */
class GetDomain extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/domains/[domainName]';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDomainName($value)
    {
        $this->data['DomainName'] = $value;
        $this->pathParameters['domainName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppGroupIdentity($value)
    {
        $this->data['AppGroupIdentity'] = $value;
        $this->options['query']['appGroupIdentity'] = $value;

        return $this;
    }
}
