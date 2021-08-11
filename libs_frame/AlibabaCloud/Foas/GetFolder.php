<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getPath()
 * @method string getProjectName()
 */
class GetFolder extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/projects/[projectName]/folders';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPath($value)
    {
        $this->data['Path'] = $value;
        $this->options['query']['path'] = $value;

        return $this;
    }

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
}
