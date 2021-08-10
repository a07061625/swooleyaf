<?php

namespace AlibabaCloud\Linkedmall;

/**
 * @method string getLmOrderId()
 * @method $this withLmOrderId($value)
 * @method string getAccountType()
 * @method $this withAccountType($value)
 * @method string getUseAnonymousTbAccount()
 * @method $this withUseAnonymousTbAccount($value)
 * @method string getThirdPartyUserId()
 * @method $this withThirdPartyUserId($value)
 * @method string getBizId()
 * @method $this withBizId($value)
 * @method string getChannelUserId()
 * @method $this withChannelUserId($value)
 */
class QueryOrderInfoAfterSale extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
