<?php

namespace AlibabaCloud\Codeup;

/**
 * @method string getOrganizationId()
 * @method string getPath()
 * @method string getSubUserId()
 * @method string getAccessToken()
 * @method string getType()
 * @method string getProjectId()
 * @method $this withProjectId($value)
 * @method string getRefName()
 */
class ListRepositoryTree extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v4/projects/[ProjectId]/repository/tree';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrganizationId($value)
    {
        $this->data['OrganizationId'] = $value;
        $this->options['query']['OrganizationId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPath($value)
    {
        $this->data['Path'] = $value;
        $this->options['query']['Path'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSubUserId($value)
    {
        $this->data['SubUserId'] = $value;
        $this->options['query']['SubUserId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccessToken($value)
    {
        $this->data['AccessToken'] = $value;
        $this->options['query']['AccessToken'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withType($value)
    {
        $this->data['Type'] = $value;
        $this->options['query']['Type'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRefName($value)
    {
        $this->data['RefName'] = $value;
        $this->options['query']['RefName'] = $value;

        return $this;
    }
}
