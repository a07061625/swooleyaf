<?php

namespace AlibabaCloud\Codeup;

/**
 * @method string getOrganizationId()
 * @method string getProtectedBranchId()
 * @method $this withProtectedBranchId($value)
 * @method string getAccessToken()
 * @method string getProjectId()
 * @method $this withProjectId($value)
 */
class DeleteRepositoryProtectedBranch extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v4/projects/[ProjectId]/repository/protect_branches/[ProtectedBranchId]';

    /** @var string */
    public $method = 'DELETE';

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
}
