<?php

namespace AlibabaCloud\Cr;

/**
 * @method string getRepoNamespace()
 * @method $this withRepoNamespace($value)
 * @method string getRepoName()
 * @method $this withRepoName($value)
 */
class UpdateRepo extends Roa
{
    /** @var string */
    public $pathPattern = '/repos/[RepoNamespace]/[RepoName]';

    /** @var string */
    public $method = 'POST';
}
