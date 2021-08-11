<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getProjectName()
 * @method string getPackageName()
 * @method string getPageSize()
 * @method string getPageIndex()
 */
class GetRefPackageJob extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/projects/[projectName]/packages/[packageName]/jobs';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectName($value)
    {
        $this->data['ProjectName'] = $value;
        $this->pathParameters['projectName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPackageName($value)
    {
        $this->data['PackageName'] = $value;
        $this->pathParameters['packageName'] = $value;

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
    public function withPageIndex($value)
    {
        $this->data['PageIndex'] = $value;
        $this->options['query']['pageIndex'] = $value;

        return $this;
    }
}
