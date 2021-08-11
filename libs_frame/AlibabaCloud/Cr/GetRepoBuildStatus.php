<?php

namespace AlibabaCloud\Cr;

/**
 * @method string getBuildId()
 * @method $this withBuildId($value)
 * @method string getRepoNamespace()
 * @method $this withRepoNamespace($value)
 * @method string getRepoName()
 * @method $this withRepoName($value)
 */
class GetRepoBuildStatus extends Roa
{
    /** @var string */
    public $pathPattern = '/repos/[RepoNamespace]/[RepoName]/build/[BuildId]/status';
}
