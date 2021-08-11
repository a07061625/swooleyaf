<?php

namespace AlibabaCloud\Push;

/**
 * @method array getPushTask()
 * @method string getAppKey()
 * @method $this withAppKey($value)
 */
class MassPush extends Rpc
{
    /**
     * @return $this
     */
    public function withPushTask(array $pushTask)
    {
        $this->data['PushTask'] = $pushTask;
        foreach ($pushTask as $depth1 => $depth1Value) {
            if (isset($depth1Value['AndroidNotificationBarType'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidNotificationBarType'] = $depth1Value['AndroidNotificationBarType'];
            }
            if (isset($depth1Value['AndroidExtParameters'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidExtParameters'] = $depth1Value['AndroidExtParameters'];
            }
            if (isset($depth1Value['IOSBadge'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.iOSBadge'] = $depth1Value['IOSBadge'];
            }
            if (isset($depth1Value['AndroidBigBody'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidBigBody'] = $depth1Value['AndroidBigBody'];
            }
            if (isset($depth1Value['IOSBadgeAutoIncrement'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.iOSBadgeAutoIncrement'] = $depth1Value['IOSBadgeAutoIncrement'];
            }
            if (isset($depth1Value['AndroidOpenType'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidOpenType'] = $depth1Value['AndroidOpenType'];
            }
            if (isset($depth1Value['Title'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.Title'] = $depth1Value['Title'];
            }
            if (isset($depth1Value['Body'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.Body'] = $depth1Value['Body'];
            }
            if (isset($depth1Value['DeviceType'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.DeviceType'] = $depth1Value['DeviceType'];
            }
            if (isset($depth1Value['PushTime'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.PushTime'] = $depth1Value['PushTime'];
            }
            if (isset($depth1Value['SendSpeed'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.SendSpeed'] = $depth1Value['SendSpeed'];
            }
            if (isset($depth1Value['AndroidNotificationHuaweiChannel'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidNotificationHuaweiChannel'] = $depth1Value['AndroidNotificationHuaweiChannel'];
            }
            if (isset($depth1Value['AndroidPopupActivity'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidPopupActivity'] = $depth1Value['AndroidPopupActivity'];
            }
            if (isset($depth1Value['IOSRemindBody'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.iOSRemindBody'] = $depth1Value['IOSRemindBody'];
            }
            if (isset($depth1Value['AndroidRenderStyle'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidRenderStyle'] = $depth1Value['AndroidRenderStyle'];
            }
            if (isset($depth1Value['IOSExtParameters'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.iOSExtParameters'] = $depth1Value['IOSExtParameters'];
            }
            if (isset($depth1Value['AndroidNotifyType'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidNotifyType'] = $depth1Value['AndroidNotifyType'];
            }
            if (isset($depth1Value['AndroidPopupTitle'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidPopupTitle'] = $depth1Value['AndroidPopupTitle'];
            }
            if (isset($depth1Value['IOSMusic'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.iOSMusic'] = $depth1Value['IOSMusic'];
            }
            if (isset($depth1Value['IOSApnsEnv'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.iOSApnsEnv'] = $depth1Value['IOSApnsEnv'];
            }
            if (isset($depth1Value['IOSMutableContent'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.iOSMutableContent'] = $depth1Value['IOSMutableContent'];
            }
            if (isset($depth1Value['AndroidNotificationBarPriority'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidNotificationBarPriority'] = $depth1Value['AndroidNotificationBarPriority'];
            }
            if (isset($depth1Value['ExpireTime'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.ExpireTime'] = $depth1Value['ExpireTime'];
            }
            if (isset($depth1Value['AndroidNotificationVivoChannel'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidNotificationVivoChannel'] = $depth1Value['AndroidNotificationVivoChannel'];
            }
            if (isset($depth1Value['AndroidPopupBody'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidPopupBody'] = $depth1Value['AndroidPopupBody'];
            }
            if (isset($depth1Value['IOSNotificationCategory'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.iOSNotificationCategory'] = $depth1Value['IOSNotificationCategory'];
            }
            if (isset($depth1Value['AndroidNotificationXiaomiChannel'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidNotificationXiaomiChannel'] = $depth1Value['AndroidNotificationXiaomiChannel'];
            }
            if (isset($depth1Value['StoreOffline'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.StoreOffline'] = $depth1Value['StoreOffline'];
            }
            if (isset($depth1Value['IOSSilentNotification'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.iOSSilentNotification'] = $depth1Value['IOSSilentNotification'];
            }
            if (isset($depth1Value['JobKey'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.JobKey'] = $depth1Value['JobKey'];
            }
            if (isset($depth1Value['Target'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.Target'] = $depth1Value['Target'];
            }
            if (isset($depth1Value['AndroidBigTitle'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidBigTitle'] = $depth1Value['AndroidBigTitle'];
            }
            if (isset($depth1Value['AndroidOpenUrl'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidOpenUrl'] = $depth1Value['AndroidOpenUrl'];
            }
            if (isset($depth1Value['AndroidNotificationChannel'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidNotificationChannel'] = $depth1Value['AndroidNotificationChannel'];
            }
            if (isset($depth1Value['AndroidRemind'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidRemind'] = $depth1Value['AndroidRemind'];
            }
            if (isset($depth1Value['AndroidActivity'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidActivity'] = $depth1Value['AndroidActivity'];
            }
            if (isset($depth1Value['AndroidXiaoMiNotifyBody'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidXiaoMiNotifyBody'] = $depth1Value['AndroidXiaoMiNotifyBody'];
            }
            if (isset($depth1Value['IOSSubtitle'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.iOSSubtitle'] = $depth1Value['IOSSubtitle'];
            }
            if (isset($depth1Value['AndroidXiaomiBigPictureUrl'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidXiaomiBigPictureUrl'] = $depth1Value['AndroidXiaomiBigPictureUrl'];
            }
            if (isset($depth1Value['IOSRemind'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.iOSRemind'] = $depth1Value['IOSRemind'];
            }
            if (isset($depth1Value['AndroidNotificationNotifyId'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidNotificationNotifyId'] = $depth1Value['AndroidNotificationNotifyId'];
            }
            if (isset($depth1Value['TargetValue'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.TargetValue'] = $depth1Value['TargetValue'];
            }
            if (isset($depth1Value['AndroidMusic'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidMusic'] = $depth1Value['AndroidMusic'];
            }
            if (isset($depth1Value['AndroidXiaoMiActivity'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidXiaoMiActivity'] = $depth1Value['AndroidXiaoMiActivity'];
            }
            if (isset($depth1Value['AndroidXiaoMiNotifyTitle'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.AndroidXiaoMiNotifyTitle'] = $depth1Value['AndroidXiaoMiNotifyTitle'];
            }
            if (isset($depth1Value['IOSNotificationCollapseId'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.iOSNotificationCollapseId'] = $depth1Value['IOSNotificationCollapseId'];
            }
            if (isset($depth1Value['PushType'])) {
                $this->options['form_params']['PushTask.' . ($depth1 + 1) . '.PushType'] = $depth1Value['PushType'];
            }
        }

        return $this;
    }
}
