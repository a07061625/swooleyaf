#!/bin/bash
set -o nounset
set -o errexit

PATH_ROOT=/e/phpspace/swooleyaf/libs_frame
PATH_SDK=${PATH_ROOT}/alipay-sdk-php-all-master/aop/request

CLI_PARAM1=${1:-''}
if [ "${CLI_PARAM1}aaa" == "aaa" ]; then
    echo -e "\e[1;31m param1 not be empty \e[0m"
    exit 0
fi

CLI_PARAM2=${2:-''}
if [ "${CLI_PARAM2}aaa" == "aaa" ]; then
    echo -e "\e[1;31m param2 not be empty \e[0m"
    exit 0
fi

if [ "${CLI_PARAM1}" == "Alipay" ]; then
    PATH_OUTPUT=${PATH_ROOT}/SyAliPay/${CLI_PARAM2}
    NAMESPACE="SyAliPay\\\\${CLI_PARAM2}"
else
    PATH_OUTPUT=${PATH_ROOT}/SyAliPay/${CLI_PARAM1}/${CLI_PARAM2}
    NAMESPACE="SyAliPay\\\\${CLI_PARAM1}\\\\${CLI_PARAM2}"
fi

CLI_PARAM="${CLI_PARAM1}${CLI_PARAM2}"
CLI_PARAM3=${3:-''}
if [ "${CLI_PARAM3}aaa" != "aaa" ]; then
    PATH_OUTPUT=${PATH_OUTPUT}/${CLI_PARAM3}
    NAMESPACE=${NAMESPACE}"\\\\"${CLI_PARAM3}
    CLI_PARAM="${CLI_PARAM}${CLI_PARAM3}"
fi

# shellcheck disable=SC2086
if [ ! -e ${PATH_OUTPUT} ]; then
    # shellcheck disable=SC2086
    mkdir -p ${PATH_OUTPUT}
fi

cd ${PATH_SDK}
# shellcheck disable=SC2006
# shellcheck disable=SC2010
for name in `ls | grep "${CLI_PARAM}"` ; do
    # shellcheck disable=SC2086
    sed -i "2inamespace ${NAMESPACE};\n" ${name}
    # shellcheck disable=SC2086
    sed -i "s/class ${CLI_PARAM}/class /g" ${name}
    # shellcheck disable=SC2001
    name2=`echo "${name}" | sed -e "s/^${CLI_PARAM}//"`
    # shellcheck disable=SC2086
    mv ${name} ${PATH_OUTPUT}/${name2}
done
