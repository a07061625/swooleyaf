<?php

namespace AlibabaCloud\Mts;

/**
 * @method string getPolitics()
 * @method $this withPolitics($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getAbuse()
 * @method $this withAbuse($value)
 * @method string getQrcode()
 * @method $this withQrcode($value)
 * @method string getPorn()
 * @method $this withPorn($value)
 * @method string getTerrorism()
 * @method $this withTerrorism($value)
 * @method string getLogo()
 * @method $this withLogo($value)
 * @method string getLive()
 * @method $this withLive($value)
 * @method string getContraband()
 * @method $this withContraband($value)
 * @method string getAd()
 * @method $this withAd($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTemplateId()
 * @method $this withTemplateId($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getSpam()
 */
class UpdateMCTemplate extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSpam($value)
    {
        $this->data['Spam'] = $value;
        $this->options['query']['spam'] = $value;

        return $this;
    }
}
