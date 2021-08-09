<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateAudit
 * @method string getAuditContent()
 */
class AuditCreateRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('vod', '2017-03-21', 'CreateAudit', 'vod');
    }

    /**
     * @param string $auditContent
     * @return $this
     */
    public function setAuditContent($auditContent)
    {
        $this->requestParameters['AuditContent'] = $auditContent;
        $this->queryParameters['AuditContent'] = $auditContent;

        return $this;
    }
}
