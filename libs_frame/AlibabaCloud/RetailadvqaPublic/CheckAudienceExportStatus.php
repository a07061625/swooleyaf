<?php

namespace AlibabaCloud\RetailadvqaPublic;

/**
 * @method string getAccessId()
 * @method $this withAccessId($value)
 * @method string getTenantId()
 * @method $this withTenantId($value)
 * @method string getAudienceId()
 * @method $this withAudienceId($value)
 */
class CheckAudienceExportStatus extends Rpc
{
    /** @var string */
    public $scheme = 'https';

    /** @var string */
    public $method = 'GET';
}
