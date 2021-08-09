<?php
namespace AliOpen\Ehpc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteJobTemplates
 * @method string getTemplates()
 */
class DeleteJobTemplatesRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('EHPC', '2018-04-12', 'DeleteJobTemplates', 'ehs');
    }

    /**
     * @param string $templates
     * @return $this
     */
    public function setTemplates($templates)
    {
        $this->requestParameters['Templates'] = $templates;
        $this->queryParameters['Templates'] = $templates;

        return $this;
    }
}
