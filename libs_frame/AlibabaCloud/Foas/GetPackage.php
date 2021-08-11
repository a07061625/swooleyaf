<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getProjectName()
 * @method string getPackageName()
 */
class GetPackage extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/projects/[projectName]/packages/[packageName]';

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
}
