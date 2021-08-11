<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getAppGroupIdentity()
 */
class ListSlowQueryCategories extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/app-groups/[appGroupIdentity]/optimizers/slow-query/categories';

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
