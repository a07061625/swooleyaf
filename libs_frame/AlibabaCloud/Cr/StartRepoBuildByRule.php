<?php

namespace AlibabaCloud\Cr;

/**
 * @method string getBuildRuleId()
 * @method $this withBuildRuleId($value)
 * @method string getRepoNamespace()
 * @method $this withRepoNamespace($value)
 * @method string getRepoName()
 * @method $this withRepoName($value)
 */
class StartRepoBuildByRule extends Roa
{
    /** @var string */
    public $pathPattern = '/repos/[RepoNamespace]/[RepoName]/rules/[BuildRuleId]/build';

    /** @var string */
    public $method = 'PUT';
}
