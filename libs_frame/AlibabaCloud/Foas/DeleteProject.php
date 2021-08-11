<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getProjectName()
 */
class DeleteProject extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/projects/[projectName]';

    /** @var string */
    public $method = 'DELETE';

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
