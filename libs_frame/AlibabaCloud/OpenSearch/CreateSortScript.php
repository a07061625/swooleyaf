<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getAppVersionId()
 * @method string getAppGroupIdentity()
 */
class CreateSortScript extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/app-groups/[appGroupIdentity]/apps/[appVersionId]/sort-scripts';

    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppVersionId($value)
    {
        $this->data['AppVersionId'] = $value;
        $this->pathParameters['appVersionId'] = $value;

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
        $this->pathParameters['appGroupIdentity'] = $value;

        return $this;
    }
}
