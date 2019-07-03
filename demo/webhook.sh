#! /bin/sh

case "$1" in
    pusha000)
        source /etc/profile && cd /xdata/phpspace/cjdb2c_api && /usr/local/php7/bin/php helper_service_manager.php -s stop-all && git pull origin feature_2 && sleep 2 && ps -A -o pid,ppid,stat,cmd|grep a06|grep -v 'grep'|awk '{print $1}'|xargs -n1 -I {} kill -9 {} && /usr/local/php7/bin/php helper_service_manager.php -s start-all
        cd /xdata/apidoc && apidoc --silent -i /xdata/phpspace/cjdb2c_api -o /xdata/apidoc/xshcjdb2capi
        ;;
    *)
        echo "the option is not support"
        ;;
esac