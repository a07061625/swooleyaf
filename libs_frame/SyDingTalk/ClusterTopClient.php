<?php

namespace SyDingTalk;

class ClusterTopClient extends TopClient
{
    private static $dnsconfig;
    private static $syncDate = 0;
    private static $applicationVar;
    private static $cfgDuration = 10;

    public function __construct($appkey = '', $secretKey = '')
    {
        self::$applicationVar = new ApplicationVar();
        $this->appkey = $appkey;
        $this->secretKey = $secretKey;
        $saveConfig = self::$applicationVar->getValue();

        if ($saveConfig) {
            $tmpConfig = $saveConfig['dnsconfig'];
            self::$dnsconfig = $this->object_to_array($tmpConfig);
            unset($tmpConfig);

            self::$syncDate = $saveConfig['syncDate'];
            if (!self::$syncDate) {
                self::$syncDate = 0;
            }
        }
    }

    public function __destruct()
    {
        if (self::$dnsconfig && self::$syncDate) {
            self::$applicationVar->setValue('dnsconfig', self::$dnsconfig);
            self::$applicationVar->setValue('syncDate', self::$syncDate);
            self::$applicationVar->write();
        }
    }

    public function execute($request = null, $session = null, $bestUrl = null)
    {
        $currentDate = date('U');
        $syncDuration = $this->getDnsConfigSyncDuration();
        $bestUrl = $this->getBestVipUrl($this->gatewayUrl, $request->getApiMethodName(), $session);
        if ($currentDate - self::$syncDate > $syncDuration * 60) {
            $httpdns = new HttpDNSGetRequest();
            self::$dnsconfig = json_decode(parent::execute($httpdns, null, $bestUrl)->result, true);
            self::$syncDate = date('U');
        }

        return parent::execute($request, $session, $bestUrl);
    }

    private function getDnsConfigSyncDuration()
    {
        if (self::$cfgDuration) {
            return self::$cfgDuration;
        }
        if (!self::$dnsconfig) {
            return self::$cfgDuration;
        }
        $config = json_encode(self::$dnsconfig);
        if (!$config) {
            return self::$cfgDuration;
        }
        $config = self::$dnsconfig['config'];
        $duration = $config['interval'];
        self::$cfgDuration = $duration;

        return self::$cfgDuration;
    }

    private function getBestVipUrl($url, $apiname = null, $session = null)
    {
        $config = self::$dnsconfig['config'];
        $degrade = $config['degrade'];
        if (0 == strcmp($degrade, 'true')) {
            return $url;
        }
        $currentEnv = $this->getEnvByApiName($apiname, $session);
        $vip = $this->getVipByEnv($url, $currentEnv);
        if ($vip) {
            return $vip;
        }

        return $url;
    }

    private function getVipByEnv($comUrl, $currentEnv)
    {
        $urlSchema = parse_url($comUrl);
        if (!$urlSchema) {
            return;
        }
        if (!self::$dnsconfig['env']) {
            return;
        }

        if (!\array_key_exists($currentEnv, self::$dnsconfig['env'])) {
            return;
        }

        $hostList = self::$dnsconfig['env'][$currentEnv];
        if (!$hostList) {
            return;
        }

        $vipList = null;
        foreach ($hostList as $key => $value) {
            if (0 == strcmp($key, $urlSchema['host']) && 0 == strcmp($value['proto'], $urlSchema['scheme'])) {
                $vipList = $value;

                break;
            }
        }
        $vip = $this->getRandomWeightElement($vipList['vip']);

        if ($vip) {
            return $urlSchema['scheme'] . '://' . $vip . $urlSchema['path'];
        }
    }

    private function getEnvByApiName($apiName, $session = '')
    {
        $apiCfgArray = self::$dnsconfig['api'];
        if ($apiCfgArray && \array_key_exists($apiName, $apiCfgArray)) {
            $apiCfg = $apiCfgArray[$apiName];
            if (\array_key_exists('user', $apiCfg)) {
                $userFlag = $apiCfg['user'];
                $flag = $this->getUserFlag($session);
                if ($userFlag && $flag) {
                    return $this->getEnvBySessionFlag($userFlag, $flag);
                }

                return $this->getRandomWeightElement($apiCfg['rule']);
            }
        }

        return $this->getDeafultEnv();
    }

    private function getUserFlag($session)
    {
        if ($session && \strlen($session) > 5) {
            if ('6' == $session[0] || '7' == $session[0]) {
                return $session[\strlen($session) - 1];
            }
            if ('5' == $session[0] || '8' == $session[0]) {
                return $session[5];
            }
        }
    }

    private function getEnvBySessionFlag($targetConfig, $flag)
    {
        if ($flag) {
            $userConf = self::$dnsconfig['user'];
            $cfgArry = $userConf[$targetConfig];
            foreach ($cfgArry as $key => $value) {
                if (\in_array($flag, $value)) {
                    return $key;
                }
            }
        }
    }

    private function getRandomWeightElement($elements)
    {
        $totalWeight = 0;
        if ($elements) {
            foreach ($elements as $ele) {
                $weight = $this->getElementWeight($ele);
                $r = $this->randomFloat() * ($weight + $totalWeight);
                if ($r >= $totalWeight) {
                    $selected = $ele;
                }
                $totalWeight += $weight;
            }
            if ($selected) {
                return $this->getElementValue($selected);
            }
        }
    }

    private function getElementWeight($ele)
    {
        $params = explode('|', $ele);

        return (float)($params[1]);
    }

    private function getElementValue($ele)
    {
        $params = explode('|', $ele);

        return $params[0];
    }

    private function getDeafultEnv()
    {
        return self::$dnsconfig['config']['def_env'];
    }

    private static function startsWith($haystack, $needle)
    {
        return '' === $needle || 0 === strpos($haystack, $needle);
    }

    private function object_to_array($obj)
    {
        $_arr = \is_object($obj) ? get_object_vars($obj) : $obj;
        foreach ($_arr as $key => $val) {
            $val = (\is_array($val) || \is_object($val)) ? $this->object_to_array($val) : $val;
            $arr[$key] = $val;
        }

        return $arr;
    }

    private function randomFloat($min = 0, $max = 1)
    {
        return $min + mt_rand() / mt_getrandmax() * ($max - $min);
    }
}
