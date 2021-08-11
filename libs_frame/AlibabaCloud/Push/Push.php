<?php

namespace AlibabaCloud\Push;

/**
 * @method string getAndroidNotificationBarType()
 * @method $this withAndroidNotificationBarType($value)
 * @method string getSmsSendPolicy()
 * @method $this withSmsSendPolicy($value)
 * @method string getBody()
 * @method $this withBody($value)
 * @method string getDeviceType()
 * @method $this withDeviceType($value)
 * @method string getPushTime()
 * @method $this withPushTime($value)
 * @method string getSendSpeed()
 * @method $this withSendSpeed($value)
 * @method string getAndroidNotificationHuaweiChannel()
 * @method $this withAndroidNotificationHuaweiChannel($value)
 * @method string getAndroidPopupActivity()
 * @method $this withAndroidPopupActivity($value)
 * @method string getIOSRemindBody()
 * @method string getAndroidNotifyType()
 * @method $this withAndroidNotifyType($value)
 * @method string getAndroidPopupTitle()
 * @method $this withAndroidPopupTitle($value)
 * @method string getIOSMusic()
 * @method string getIOSApnsEnv()
 * @method string getIOSMutableContent()
 * @method string getAndroidNotificationBarPriority()
 * @method $this withAndroidNotificationBarPriority($value)
 * @method string getExpireTime()
 * @method $this withExpireTime($value)
 * @method string getAndroidNotificationVivoChannel()
 * @method $this withAndroidNotificationVivoChannel($value)
 * @method string getIOSNotificationCategory()
 * @method string getAndroidNotificationXiaomiChannel()
 * @method $this withAndroidNotificationXiaomiChannel($value)
 * @method string getStoreOffline()
 * @method $this withStoreOffline($value)
 * @method string getSmsParams()
 * @method $this withSmsParams($value)
 * @method string getJobKey()
 * @method $this withJobKey($value)
 * @method string getAndroidOpenUrl()
 * @method $this withAndroidOpenUrl($value)
 * @method string getAndroidXiaoMiNotifyBody()
 * @method $this withAndroidXiaoMiNotifyBody($value)
 * @method string getIOSSubtitle()
 * @method string getAndroidXiaomiBigPictureUrl()
 * @method $this withAndroidXiaomiBigPictureUrl($value)
 * @method string getIOSRemind()
 * @method string getAndroidMusic()
 * @method $this withAndroidMusic($value)
 * @method string getIOSNotificationCollapseId()
 * @method string getPushType()
 * @method $this withPushType($value)
 * @method string getAndroidExtParameters()
 * @method $this withAndroidExtParameters($value)
 * @method string getIOSBadge()
 * @method string getAndroidBigBody()
 * @method $this withAndroidBigBody($value)
 * @method string getIOSBadgeAutoIncrement()
 * @method string getAndroidOpenType()
 * @method $this withAndroidOpenType($value)
 * @method string getTitle()
 * @method $this withTitle($value)
 * @method string getSmsDelaySecs()
 * @method $this withSmsDelaySecs($value)
 * @method string getAndroidRenderStyle()
 * @method $this withAndroidRenderStyle($value)
 * @method string getIOSExtParameters()
 * @method string getSmsTemplateName()
 * @method $this withSmsTemplateName($value)
 * @method string getAndroidPopupBody()
 * @method $this withAndroidPopupBody($value)
 * @method string getIOSSilentNotification()
 * @method string getTarget()
 * @method $this withTarget($value)
 * @method string getAndroidBigTitle()
 * @method $this withAndroidBigTitle($value)
 * @method string getAndroidNotificationChannel()
 * @method $this withAndroidNotificationChannel($value)
 * @method string getAndroidRemind()
 * @method $this withAndroidRemind($value)
 * @method string getAndroidActivity()
 * @method $this withAndroidActivity($value)
 * @method string getSmsSignName()
 * @method $this withSmsSignName($value)
 * @method string getAndroidNotificationNotifyId()
 * @method $this withAndroidNotificationNotifyId($value)
 * @method string getAppKey()
 * @method $this withAppKey($value)
 * @method string getTargetValue()
 * @method $this withTargetValue($value)
 * @method string getAndroidXiaoMiActivity()
 * @method $this withAndroidXiaoMiActivity($value)
 * @method string getAndroidXiaoMiNotifyTitle()
 * @method $this withAndroidXiaoMiNotifyTitle($value)
 */
class Push extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIOSRemindBody($value)
    {
        $this->data['IOSRemindBody'] = $value;
        $this->options['query']['iOSRemindBody'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIOSMusic($value)
    {
        $this->data['IOSMusic'] = $value;
        $this->options['query']['iOSMusic'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIOSApnsEnv($value)
    {
        $this->data['IOSApnsEnv'] = $value;
        $this->options['query']['iOSApnsEnv'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIOSMutableContent($value)
    {
        $this->data['IOSMutableContent'] = $value;
        $this->options['query']['iOSMutableContent'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIOSNotificationCategory($value)
    {
        $this->data['IOSNotificationCategory'] = $value;
        $this->options['query']['iOSNotificationCategory'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIOSSubtitle($value)
    {
        $this->data['IOSSubtitle'] = $value;
        $this->options['query']['iOSSubtitle'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIOSRemind($value)
    {
        $this->data['IOSRemind'] = $value;
        $this->options['query']['iOSRemind'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIOSNotificationCollapseId($value)
    {
        $this->data['IOSNotificationCollapseId'] = $value;
        $this->options['query']['iOSNotificationCollapseId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIOSBadge($value)
    {
        $this->data['IOSBadge'] = $value;
        $this->options['query']['iOSBadge'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIOSBadgeAutoIncrement($value)
    {
        $this->data['IOSBadgeAutoIncrement'] = $value;
        $this->options['query']['iOSBadgeAutoIncrement'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIOSExtParameters($value)
    {
        $this->data['IOSExtParameters'] = $value;
        $this->options['query']['iOSExtParameters'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIOSSilentNotification($value)
    {
        $this->data['IOSSilentNotification'] = $value;
        $this->options['query']['iOSSilentNotification'] = $value;

        return $this;
    }
}
