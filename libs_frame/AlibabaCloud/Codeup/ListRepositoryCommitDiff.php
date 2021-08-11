<?php

namespace AlibabaCloud\Codeup;

/**
 * @method string getOrganizationId()
 * @method string getAccessToken()
 * @method string getContextLine()
 * @method string getProjectId()
 * @method $this withProjectId($value)
 * @method string getSha()
 * @method $this withSha($value)
 */
class ListRepositoryCommitDiff extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v3/projects/[ProjectId]/repository/commits/[Sha]/diff';

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
    public function withContextLine($value)
    {
        $this->data['ContextLine'] = $value;
        $this->options['query']['ContextLine'] = $value;

        return $this;
    }
}
