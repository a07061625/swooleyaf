<?php

namespace AlibabaCloud\Cr;

/**
 * @method string getWebhookId()
 * @method $this withWebhookId($value)
 * @method string getRepoNamespace()
 * @method $this withRepoNamespace($value)
 * @method string getRepoName()
 * @method $this withRepoName($value)
 */
class DeleteRepoWebhook extends Roa
{
    /** @var string */
    public $pathPattern = '/repos/[RepoNamespace]/[RepoName]/webhooks/[WebhookId]';

    /** @var string */
    public $method = 'DELETE';
}
