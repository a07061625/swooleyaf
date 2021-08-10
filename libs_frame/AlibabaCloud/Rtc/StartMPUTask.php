<?php

namespace AlibabaCloud\Rtc;

/**
 * @method string getPayloadType()
 * @method $this withPayloadType($value)
 * @method array getUserPanes()
 * @method string getBackgroundColor()
 * @method $this withBackgroundColor($value)
 * @method string getReportVad()
 * @method $this withReportVad($value)
 * @method string getSourceType()
 * @method $this withSourceType($value)
 * @method string getTaskId()
 * @method $this withTaskId($value)
 * @method array getClockWidgets()
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getVadInterval()
 * @method $this withVadInterval($value)
 * @method array getWatermarks()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getMediaEncode()
 * @method $this withMediaEncode($value)
 * @method string getRtpExtInfo()
 * @method $this withRtpExtInfo($value)
 * @method string getCropMode()
 * @method $this withCropMode($value)
 * @method string getTaskProfile()
 * @method $this withTaskProfile($value)
 * @method array getLayoutIds()
 * @method string getStreamURL()
 * @method $this withStreamURL($value)
 * @method string getStreamType()
 * @method $this withStreamType($value)
 * @method array getSubSpecUsers()
 * @method string getAppId()
 * @method $this withAppId($value)
 * @method array getBackgrounds()
 * @method string getTimeStampRef()
 * @method $this withTimeStampRef($value)
 * @method string getMixMode()
 * @method $this withMixMode($value)
 * @method string getChannelId()
 * @method $this withChannelId($value)
 */
class StartMPUTask extends Rpc
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
    public function withClockWidgets(array $clockWidgets)
    {
        $this->data['ClockWidgets'] = $clockWidgets;
        foreach ($clockWidgets as $depth1 => $depth1Value) {
            if (isset($depth1Value['X'])) {
                $this->options['query']['ClockWidgets.' . ($depth1 + 1) . '.X'] = $depth1Value['X'];
            }
            if (isset($depth1Value['Y'])) {
                $this->options['query']['ClockWidgets.' . ($depth1 + 1) . '.Y'] = $depth1Value['Y'];
            }
            if (isset($depth1Value['FontType'])) {
                $this->options['query']['ClockWidgets.' . ($depth1 + 1) . '.FontType'] = $depth1Value['FontType'];
            }
            if (isset($depth1Value['FontSize'])) {
                $this->options['query']['ClockWidgets.' . ($depth1 + 1) . '.FontSize'] = $depth1Value['FontSize'];
            }
            if (isset($depth1Value['FontColor'])) {
                $this->options['query']['ClockWidgets.' . ($depth1 + 1) . '.FontColor'] = $depth1Value['FontColor'];
            }
            if (isset($depth1Value['ZOrder'])) {
                $this->options['query']['ClockWidgets.' . ($depth1 + 1) . '.ZOrder'] = $depth1Value['ZOrder'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withWatermarks(array $watermarks)
    {
        $this->data['Watermarks'] = $watermarks;
        foreach ($watermarks as $depth1 => $depth1Value) {
            if (isset($depth1Value['Url'])) {
                $this->options['query']['Watermarks.' . ($depth1 + 1) . '.Url'] = $depth1Value['Url'];
            }
            if (isset($depth1Value['Alpha'])) {
                $this->options['query']['Watermarks.' . ($depth1 + 1) . '.Alpha'] = $depth1Value['Alpha'];
            }
            if (isset($depth1Value['Display'])) {
                $this->options['query']['Watermarks.' . ($depth1 + 1) . '.Display'] = $depth1Value['Display'];
            }
            if (isset($depth1Value['X'])) {
                $this->options['query']['Watermarks.' . ($depth1 + 1) . '.X'] = $depth1Value['X'];
            }
            if (isset($depth1Value['Y'])) {
                $this->options['query']['Watermarks.' . ($depth1 + 1) . '.Y'] = $depth1Value['Y'];
            }
            if (isset($depth1Value['Width'])) {
                $this->options['query']['Watermarks.' . ($depth1 + 1) . '.Width'] = $depth1Value['Width'];
            }
            if (isset($depth1Value['Height'])) {
                $this->options['query']['Watermarks.' . ($depth1 + 1) . '.Height'] = $depth1Value['Height'];
            }
            if (isset($depth1Value['ZOrder'])) {
                $this->options['query']['Watermarks.' . ($depth1 + 1) . '.ZOrder'] = $depth1Value['ZOrder'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withLayoutIds(array $layoutIds)
    {
        $this->data['LayoutIds'] = $layoutIds;
        foreach ($layoutIds as $i => $iValue) {
            $this->options['query']['LayoutIds.' . ($i + 1)] = $iValue;
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

    /**
     * @return $this
     */
    public function withBackgrounds(array $backgrounds)
    {
        $this->data['Backgrounds'] = $backgrounds;
        foreach ($backgrounds as $depth1 => $depth1Value) {
            if (isset($depth1Value['Url'])) {
                $this->options['query']['Backgrounds.' . ($depth1 + 1) . '.Url'] = $depth1Value['Url'];
            }
            if (isset($depth1Value['Display'])) {
                $this->options['query']['Backgrounds.' . ($depth1 + 1) . '.Display'] = $depth1Value['Display'];
            }
            if (isset($depth1Value['X'])) {
                $this->options['query']['Backgrounds.' . ($depth1 + 1) . '.X'] = $depth1Value['X'];
            }
            if (isset($depth1Value['Y'])) {
                $this->options['query']['Backgrounds.' . ($depth1 + 1) . '.Y'] = $depth1Value['Y'];
            }
            if (isset($depth1Value['Width'])) {
                $this->options['query']['Backgrounds.' . ($depth1 + 1) . '.Width'] = $depth1Value['Width'];
            }
            if (isset($depth1Value['Height'])) {
                $this->options['query']['Backgrounds.' . ($depth1 + 1) . '.Height'] = $depth1Value['Height'];
            }
            if (isset($depth1Value['ZOrder'])) {
                $this->options['query']['Backgrounds.' . ($depth1 + 1) . '.ZOrder'] = $depth1Value['ZOrder'];
            }
        }

        return $this;
    }
}
