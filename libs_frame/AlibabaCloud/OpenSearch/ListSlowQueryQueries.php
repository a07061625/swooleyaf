<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getCategoryIndex()
 * @method string getAppGroupIdentity()
 */
class ListSlowQueryQueries extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/app-groups/[appGroupIdentity]/optimizers/slow-query/categories/[categoryIndex]/queries';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCategoryIndex($value)
    {
        $this->data['CategoryIndex'] = $value;
        $this->pathParameters['categoryIndex'] = $value;

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
