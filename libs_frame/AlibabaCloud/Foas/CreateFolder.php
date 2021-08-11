<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getPath()
 * @method string getProjectName()
 */
class CreateFolder extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/projects/[projectName]/folders';

    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPath($value)
    {
        $this->data['Path'] = $value;
        $this->options['form_params']['path'] = $value;

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
