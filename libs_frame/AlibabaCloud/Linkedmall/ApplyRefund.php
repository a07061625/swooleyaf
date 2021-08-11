<?php

namespace AlibabaCloud\Linkedmall;

/**
 * @method string getBizUid()
 * @method $this withBizUid($value)
 * @method string getBizClaimType()
 * @method $this withBizClaimType($value)
 * @method string getApplyReasonTextId()
 * @method $this withApplyReasonTextId($value)
 * @method string getAccountType()
 * @method $this withAccountType($value)
 * @method string getUseAnonymousTbAccount()
 * @method $this withUseAnonymousTbAccount($value)
 * @method array getLeavePictureList()
 * @method string getApplyRefundCount()
 * @method $this withApplyRefundCount($value)
 * @method string getGoodsStatus()
 * @method $this withGoodsStatus($value)
 * @method string getSubLmOrderId()
 * @method $this withSubLmOrderId($value)
 * @method string getThirdPartyUserId()
 * @method $this withThirdPartyUserId($value)
 * @method string getApplyRefundFee()
 * @method $this withApplyRefundFee($value)
 * @method string getBizId()
 * @method $this withBizId($value)
 * @method string getLeaveMessage()
 */
class ApplyRefund extends Rpc
{
    /**
     * @return $this
     */
    public function withLeavePictureList(array $leavePictureList)
    {
        $this->data['LeavePictureList'] = $leavePictureList;
        foreach ($leavePictureList as $depth1 => $depth1Value) {
            if (isset($depth1Value['Picture'])) {
                $this->options['form_params']['LeavePictureList.' . ($depth1 + 1) . '.Picture'] = $depth1Value['Picture'];
            }
            if (isset($depth1Value['Desc'])) {
                $this->options['form_params']['LeavePictureList.' . ($depth1 + 1) . '.Desc'] = $depth1Value['Desc'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLeaveMessage($value)
    {
        $this->data['LeaveMessage'] = $value;
        $this->options['form_params']['LeaveMessage'] = $value;

        return $this;
    }
}
