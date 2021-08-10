<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getProjectId()
 * @method $this withProjectId($value)
 */
class GetEmonGrafanaDashboards extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/emon/projects/[ProjectId]/grafana/proxy/api/search';

    /** @var string */
    public $method = 'GET';
}
