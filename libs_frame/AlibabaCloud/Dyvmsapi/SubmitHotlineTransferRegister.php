<?php

namespace AlibabaCloud\Dyvmsapi;

/**
 * @method string getOperatorIdentityCard()
 * @method $this withOperatorIdentityCard($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getOperatorMail()
 * @method $this withOperatorMail($value)
 * @method string getHotlineNumber()
 * @method $this withHotlineNumber($value)
 * @method array getTransferPhoneNumberInfos()
 * @method string getOperatorMobileVerifyCode()
 * @method $this withOperatorMobileVerifyCode($value)
 * @method string getAgreement()
 * @method $this withAgreement($value)
 * @method string getQualificationId()
 * @method $this withQualificationId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getOperatorMobile()
 * @method $this withOperatorMobile($value)
 * @method string getOperatorMailVerifyCode()
 * @method $this withOperatorMailVerifyCode($value)
 * @method string getOperatorName()
 * @method $this withOperatorName($value)
 */
class SubmitHotlineTransferRegister extends Rpc
{
    /**
     * @return $this
     */
    public function withTransferPhoneNumberInfos(array $transferPhoneNumberInfos)
    {
        $this->data['TransferPhoneNumberInfos'] = $transferPhoneNumberInfos;
        foreach ($transferPhoneNumberInfos as $depth1 => $depth1Value) {
            if (isset($depth1Value['PhoneNumber'])) {
                $this->options['query']['TransferPhoneNumberInfos.' . ($depth1 + 1) . '.PhoneNumber'] = $depth1Value['PhoneNumber'];
            }
            if (isset($depth1Value['PhoneNumberOwnerName'])) {
                $this->options['query']['TransferPhoneNumberInfos.' . ($depth1 + 1) . '.PhoneNumberOwnerName'] = $depth1Value['PhoneNumberOwnerName'];
            }
            if (isset($depth1Value['IdentityCard'])) {
                $this->options['query']['TransferPhoneNumberInfos.' . ($depth1 + 1) . '.IdentityCard'] = $depth1Value['IdentityCard'];
            }
        }

        return $this;
    }
}
