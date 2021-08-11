#!/bin/bash
set -o nounset
set -o errexit

# shellcheck disable=SC2006
FILE_ROOT_NAME=`readlink -f "$0"`
# shellcheck disable=SC2086
# shellcheck disable=SC2006
PATH_ROOT=`dirname ${FILE_ROOT_NAME}`
BIN_PHP=/d/Php72/php.exe
TRANSFORM_NUM=1

DIRS_INPUT="Imm,RetailadvqaPublic,Dcdn,IndustryBrain,Retailcloud,Ddoscoo,Iot,RKvstore,Dds,Iqa,ROS,DemoCenter,ITaaS,Rtc,DevopsRdc,Ivision,Sae,Dg,Ivpd,Saf,Dm,Jaq,Safconsole,DmsEnterprise,Jarvis,Sas,Domain,JarvisPublic,SasApi,DomainIntl,Kms,Scdn,Drcloud,Ledgerdb,Schedulerx2,Drds,Linkedmall,Scsp,Dts,LinkFace,Servicemesh,Dybaseapi,LinkWAN,Sgw,Dyplsapi,Live,Skyeye,Dypnsapi,Lubancloud,Slb,Dysmsapi,Lubanruler,Smartag,Dyvmsapi,Market,SmartHosting,Eais,MoguanSdk,Smc,Eci,MoPen,Sms,Ecs,MPaaS,SmsIntl,EcsInc,MPServerless,Snsuapi,Edas,Mts,Sts,EHPC,Multimediaai,Tag,Eipanycast,NAS,TagINner,Elasticsearch,Netana,Tdsr,Emap,Nlp,TeambitionAliyun,EmasAppmonitor,NlpAutoml,TeslaDam,Emr,NlsCloudMeta,TeslaMaxCompute,Ess,NlsFiletrans,TeslaStream,Facebody,Objectdet,Ubsms,Fnf,Ocr,UbsmsInner,Foas,Ocs,Uis,Ft,Oms,UniMkt,Ga,Ons,Vcs,Geoip,OnsMqtt,Videoenhan,Goodstech,Oos,Videorecog,Gpdb,Openanalytics,Videosearch,Green,OpenanalyticsOpen,Videoseg,Cloudgame,HBase,OpenSearch,Visionai,Cloudmarketing,OssAdmin,VisionaiPoc,CloudPhoto,Hiknoengine,Ots,Vod,Cloudwf,Hitsdb,OutboundBot,VoiceNavigator,Cms,HPC,PetaData,Vpc,Codeup,Hsm,Polardb,Vs,Commondriver,Httpdns,Polardbx,WafOpenapi,Companyreg,Idrsservice,Privatelink,WelfareInner,Config,IDST,ProductCatalog,Workorder,Cr,Imageaudit,PTS,Xspace,Crm,Imageenhan,Push,Xtrace,CS,Imageprocess,Pvtz,YqBridge,CSB,Imagerecog,Qualitycheck,Yundun,CusanalyticScOnline,ImageSearch,Ram,DataworksPublic,Imageseg,Rds,DBFS,Imgsearch,Reid"
# shellcheck disable=SC2207
DIRS_LOOP=(`echo ${DIRS_INPUT} | tr ',' ' '`)
# shellcheck disable=SC2068
for name in ${DIRS_LOOP[@]} ; do
    ${DIRS_INPUT} ${PATH_ROOT}/helper.php ${name} | awk '{print $0}'
    # shellcheck disable=SC2004
    TRANSFORM_NUM=$(( ${TRANSFORM_NUM} + 1 ))
    if [ ${TRANSFORM_NUM} -gt 5 ]; then
        git gcc | awk '{print $0}'
        TRANSFORM_NUM=0
    fi
    git add .
    git commit -m "feat(libs): update alibabacloud libs"
    git add .
    git commit -m "feat(libs): update alibabacloud libs" | awk '{print $0}'
    git push gitee master
done
