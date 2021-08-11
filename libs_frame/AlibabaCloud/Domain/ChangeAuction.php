<?php

namespace AlibabaCloud\Domain;

/**
 * @method array getAuctionList()
 */
class ChangeAuction extends Rpc
{
    /**
     * @return $this
     */
    public function withAuctionList(array $auctionList)
    {
        $this->data['AuctionList'] = $auctionList;
        foreach ($auctionList as $depth1 => $depth1Value) {
            if (isset($depth1Value['Winner'])) {
                $this->options['form_params']['AuctionList.' . ($depth1 + 1) . '.Winner'] = $depth1Value['Winner'];
            }
            if (isset($depth1Value['ReserveRange'])) {
                $this->options['form_params']['AuctionList.' . ($depth1 + 1) . '.ReserveRange'] = $depth1Value['ReserveRange'];
            }
            if (isset($depth1Value['DomainName'])) {
                $this->options['form_params']['AuctionList.' . ($depth1 + 1) . '.DomainName'] = $depth1Value['DomainName'];
            }
            if (isset($depth1Value['EndTime'])) {
                $this->options['form_params']['AuctionList.' . ($depth1 + 1) . '.EndTime'] = $depth1Value['EndTime'];
            }
            if (isset($depth1Value['TimeLeft'])) {
                $this->options['form_params']['AuctionList.' . ($depth1 + 1) . '.TimeLeft'] = $depth1Value['TimeLeft'];
            }
            if (isset($depth1Value['IsReserve'])) {
                $this->options['form_params']['AuctionList.' . ($depth1 + 1) . '.IsReserve'] = $depth1Value['IsReserve'];
            }
            foreach ($depth1Value['BidRecords'] as $depth2 => $depth2Value) {
                if (isset($depth2Value['CreateTime'])) {
                    $this->options['form_params']['AuctionList.' . ($depth1 + 1) . '.BidRecords.' . ($depth2 + 1) . '.CreateTime'] = $depth2Value['CreateTime'];
                }
                if (isset($depth2Value['Price'])) {
                    $this->options['form_params']['AuctionList.' . ($depth1 + 1) . '.BidRecords.' . ($depth2 + 1) . '.Price'] = $depth2Value['Price'];
                }
                if (isset($depth2Value['UserId'])) {
                    $this->options['form_params']['AuctionList.' . ($depth1 + 1) . '.BidRecords.' . ($depth2 + 1) . '.UserId'] = $depth2Value['UserId'];
                }
            }
            if (isset($depth1Value['WinnerPrice'])) {
                $this->options['form_params']['AuctionList.' . ($depth1 + 1) . '.WinnerPrice'] = $depth1Value['WinnerPrice'];
            }
            if (isset($depth1Value['Status'])) {
                $this->options['form_params']['AuctionList.' . ($depth1 + 1) . '.Status'] = $depth1Value['Status'];
            }
            if (isset($depth1Value['ReservePrice'])) {
                $this->options['form_params']['AuctionList.' . ($depth1 + 1) . '.ReservePrice'] = $depth1Value['ReservePrice'];
            }
        }

        return $this;
    }
}
