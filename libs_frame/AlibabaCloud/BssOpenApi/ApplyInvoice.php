<?php

namespace AlibabaCloud\BssOpenApi;

/**
 * @method string getInvoicingType()
 * @method $this withInvoicingType($value)
 * @method string getProcessWay()
 * @method $this withProcessWay($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getInvoiceAmount()
 * @method $this withInvoiceAmount($value)
 * @method string getAddressId()
 * @method $this withAddressId($value)
 * @method string getApplyUserNick()
 * @method $this withApplyUserNick($value)
 * @method string getInvoiceByAmount()
 * @method $this withInvoiceByAmount($value)
 * @method string getCustomerId()
 * @method $this withCustomerId($value)
 * @method array getSelectedIds()
 * @method string getUserRemark()
 * @method $this withUserRemark($value)
 */
class ApplyInvoice extends Rpc
{
    /**
     * @return $this
     */
    public function withSelectedIds(array $selectedIds)
    {
        $this->data['SelectedIds'] = $selectedIds;
        foreach ($selectedIds as $i => $iValue) {
            $this->options['query']['SelectedIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
