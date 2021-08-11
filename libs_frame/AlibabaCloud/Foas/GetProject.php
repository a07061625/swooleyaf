<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getProjectName()
 */
class GetProject extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/projects/[projectName]';

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
