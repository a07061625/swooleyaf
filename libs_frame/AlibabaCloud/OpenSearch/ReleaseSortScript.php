<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getAppVersionId()
 * @method string getScriptName()
 * @method string getAppGroupIdentity()
 */
class ReleaseSortScript extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/app-groups/[appGroupIdentity]/apps/[appVersionId]/sort-scripts/[scriptName]/actions/release';

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
    public function withScriptName($value)
    {
        $this->data['ScriptName'] = $value;
        $this->pathParameters['scriptName'] = $value;

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
