<?php

namespace SyDingTalk;

class ApplicationVar
{
    public $save_file;
    public $application;
    public $app_data = '';
    public $__writed = false;

    public function __construct()
    {
        $this->save_file = __DIR__ . '/httpdns.conf';
        $this->application = [];
    }

    public function __writeToFile()
    {
        $fp = @fopen($this->save_file, 'w');
        if (flock($fp, LOCK_EX | LOCK_NB)) {
            @fwrite($fp, $this->app_data);
            flock($fp, LOCK_UN);
        }
        @fclose($fp);
    }

    public function setValue($var_name, $var_value)
    {
        if (!\is_string($var_name) || empty($var_name)) {
            return false;
        }

        $this->application[$var_name] = $var_value;
    }

    public function write()
    {
        $this->app_data = @serialize($this->application);
        $this->__writeToFile();
    }

    public function getValue()
    {
        if (!is_file($this->save_file)) {
            $this->__writeToFile();
        }

        return @unserialize(@file_get_contents($this->save_file));
    }
}
