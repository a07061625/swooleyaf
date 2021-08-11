<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getProjectName()
 * @method string getSrcPath()
 * @method string getDestPath()
 */
class MVFolder extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/projects/[projectName]/folders';

    /** @var string */
    public $method = 'PUT';

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
    public function withSrcPath($value)
    {
        $this->data['SrcPath'] = $value;
        $this->options['form_params']['srcPath'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDestPath($value)
    {
        $this->data['DestPath'] = $value;
        $this->options['form_params']['destPath'] = $value;

        return $this;
    }
}
