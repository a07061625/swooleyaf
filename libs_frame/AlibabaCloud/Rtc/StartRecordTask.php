<?php

namespace AlibabaCloud\Rtc;

/**
 * @method array getUserPanes()
 * @method string getTaskId()
 * @method $this withTaskId($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTemplateId()
 * @method $this withTemplateId($value)
 * @method array getSubSpecUsers()
 * @method string getAppId()
 * @method $this withAppId($value)
 * @method string getChannelId()
 * @method $this withChannelId($value)
 */
class StartRecordTask extends Rpc
{
    /**
     * @return $this
     */
    public function withUserPanes(array $userPanes)
    {
        $this->data['UserPanes'] = $userPanes;
        foreach ($userPanes as $depth1 => $depth1Value) {
            if (isset($depth1Value['PaneId'])) {
                $this->options['query']['UserPanes.' . ($depth1 + 1) . '.PaneId'] = $depth1Value['PaneId'];
            }
            if (isset($depth1Value['UserId'])) {
                $this->options['query']['UserPanes.' . ($depth1 + 1) . '.UserId'] = $depth1Value['UserId'];
            }
            if (isset($depth1Value['SourceType'])) {
                $this->options['query']['UserPanes.' . ($depth1 + 1) . '.SourceType'] = $depth1Value['SourceType'];
            }
            foreach ($depth1Value['Images'] as $depth2 => $depth2Value) {
                if (isset($depth2Value['Url'])) {
                    $this->options['query']['UserPanes.' . ($depth1 + 1) . '.Images.' . ($depth2 + 1) . '.Url'] = $depth2Value['Url'];
                }
                if (isset($depth2Value['Display'])) {
                    $this->options['query']['UserPanes.' . ($depth1 + 1) . '.Images.' . ($depth2 + 1) . '.Display'] = $depth2Value['Display'];
                }
                if (isset($depth2Value['X'])) {
                    $this->options['query']['UserPanes.' . ($depth1 + 1) . '.Images.' . ($depth2 + 1) . '.X'] = $depth2Value['X'];
                }
                if (isset($depth2Value['Y'])) {
                    $this->options['query']['UserPanes.' . ($depth1 + 1) . '.Images.' . ($depth2 + 1) . '.Y'] = $depth2Value['Y'];
                }
                if (isset($depth2Value['Width'])) {
                    $this->options['query']['UserPanes.' . ($depth1 + 1) . '.Images.' . ($depth2 + 1) . '.Width'] = $depth2Value['Width'];
                }
                if (isset($depth2Value['Height'])) {
                    $this->options['query']['UserPanes.' . ($depth1 + 1) . '.Images.' . ($depth2 + 1) . '.Height'] = $depth2Value['Height'];
                }
                if (isset($depth2Value['ZOrder'])) {
                    $this->options['query']['UserPanes.' . ($depth1 + 1) . '.Images.' . ($depth2 + 1) . '.ZOrder'] = $depth2Value['ZOrder'];
                }
            }
            foreach ($depth1Value['Texts'] as $depth2 => $depth2Value) {
                if (isset($depth2Value['Text'])) {
                    $this->options['query']['UserPanes.' . ($depth1 + 1) . '.Texts.' . ($depth2 + 1) . '.Text'] = $depth2Value['Text'];
                }
                if (isset($depth2Value['X'])) {
                    $this->options['query']['UserPanes.' . ($depth1 + 1) . '.Texts.' . ($depth2 + 1) . '.X'] = $depth2Value['X'];
                }
                if (isset($depth2Value['Y'])) {
                    $this->options['query']['UserPanes.' . ($depth1 + 1) . '.Texts.' . ($depth2 + 1) . '.Y'] = $depth2Value['Y'];
                }
                if (isset($depth2Value['FontType'])) {
                    $this->options['query']['UserPanes.' . ($depth1 + 1) . '.Texts.' . ($depth2 + 1) . '.FontType'] = $depth2Value['FontType'];
                }
                if (isset($depth2Value['FontSize'])) {
                    $this->options['query']['UserPanes.' . ($depth1 + 1) . '.Texts.' . ($depth2 + 1) . '.FontSize'] = $depth2Value['FontSize'];
                }
                if (isset($depth2Value['FontColor'])) {
                    $this->options['query']['UserPanes.' . ($depth1 + 1) . '.Texts.' . ($depth2 + 1) . '.FontColor'] = $depth2Value['FontColor'];
                }
                if (isset($depth2Value['ZOrder'])) {
                    $this->options['query']['UserPanes.' . ($depth1 + 1) . '.Texts.' . ($depth2 + 1) . '.ZOrder'] = $depth2Value['ZOrder'];
                }
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withSubSpecUsers(array $subSpecUsers)
    {
        $this->data['SubSpecUsers'] = $subSpecUsers;
        foreach ($subSpecUsers as $i => $iValue) {
            $this->options['query']['SubSpecUsers.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
