#!/bin/bash
set -o nounset
set -o errexit

# shellcheck disable=SC2006
FILE_ROOT_NAME=`readlink -f "$0"`
# shellcheck disable=SC2086
# shellcheck disable=SC2006
PATH_ROOT=`dirname ${FILE_ROOT_NAME}`
BIN_PHP=/d/Php72/php.exe
TRANSFORM_NUM=0
GIT_RESOURCES_REPOSITORY="gitee"
GIT_RESOURCES_BRANCH="master"
GIT_COMMIT_CONTENT="feat(libs): update alibabacloud libs"

# shellcheck disable=SC2010
# shellcheck disable=SC2006
for name in `ls -F | grep "/$" | awk -F/ '{print $1}'` ; do
    if [ "${name}" == "Client" ]; then
        continue
    fi
    FILE_RESOLVER=${PATH_ROOT}/${name}/${name}ApiResolver.php
    if [ ! -e "${FILE_RESOLVER}" ]; then
        continue
    fi

    ${BIN_PHP} ${PATH_ROOT}/helper.php ${name} | awk '{print $0}'
    # shellcheck disable=SC2004
    TRANSFORM_NUM=$(( ${TRANSFORM_NUM} + 1 ))
    if [ ${TRANSFORM_NUM} -gt 5 ]; then
        git gc | awk '{print $0}'
        TRANSFORM_NUM=0
    fi
    git add .
    git commit -m "${GIT_COMMIT_CONTENT}" | awk '{print $0}'
    git add .
    git commit -m "${GIT_COMMIT_CONTENT}" | awk '{print $0}'
    git push ${GIT_RESOURCES_REPOSITORY} ${GIT_RESOURCES_BRANCH}
done
