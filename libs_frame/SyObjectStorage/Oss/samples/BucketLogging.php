<?php
require_once __DIR__ . '/Common.php';

use SyObjectStorage\Oss\OssClient;
use SyObjectStorage\Oss\Core\OssException;

$bucket = Common::getBucketName();
$ossClient = Common::getOssClient();
if (is_null($ossClient)) {
    exit(1);
}

//*******************************Simple Usage ***************************************************************

// Set bucket access logging rules. Access logs are stored under the same bucket with a 'access.log' prefix.
$ossClient->putBucketLogging($bucket, $bucket, "access.log", []);
Common::println("bucket $bucket lifecycleConfig created");

// Get bucket access logging rules
$loggingConfig = $ossClient->getBucketLogging($bucket, []);
Common::println("bucket $bucket lifecycleConfig fetched:" . $loggingConfig->serializeToXml());

// Delete bucket access logging rules
$loggingConfig = $ossClient->getBucketLogging($bucket, []);
Common::println("bucket $bucket lifecycleConfig deleted");

//******************************* For complete usage, see the following functions ****************************************************

putBucketLogging($ossClient, $bucket);
getBucketLogging($ossClient, $bucket);
deleteBucketLogging($ossClient, $bucket);
getBucketLogging($ossClient, $bucket);

/**
 * Set bucket logging configuration
 * @param \SyObjectStorage\Oss\OssClient $ossClient OssClient instance
 * @param string $bucket bucket name
 * @return null
 */
function putBucketLogging($ossClient, $bucket)
{
    $option = [];
    // Access logs are stored in the same bucket.
    $targetBucket = $bucket;
    $targetPrefix = "access.log";

    try {
        $ossClient->putBucketLogging($bucket, $targetBucket, $targetPrefix, $option);
    } catch (OssException $e) {
        printf(__FUNCTION__ . ": FAILED\n");
        printf($e->getMessage() . "\n");

        return;
    }
    print(__FUNCTION__ . ": OK" . "\n");
}

/**
 * Get bucket logging configuration
 * @param \SyObjectStorage\Oss\OssClient $ossClient OssClient instance
 * @param string $bucket bucket name
 * @return null
 */
function getBucketLogging($ossClient, $bucket)
{
    $loggingConfig = null;
    $options = [];
    try {
        $loggingConfig = $ossClient->getBucketLogging($bucket, $options);
    } catch (OssException $e) {
        printf(__FUNCTION__ . ": FAILED\n");
        printf($e->getMessage() . "\n");

        return;
    }
    print(__FUNCTION__ . ": OK" . "\n");
    print($loggingConfig->serializeToXml() . "\n");
}

/**
 * Delete bucket logging configuration
 * @param \SyObjectStorage\Oss\OssClient $ossClient OssClient instance
 * @param string $bucket bucket name
 * @return null
 */
function deleteBucketLogging($ossClient, $bucket)
{
    try {
        $ossClient->deleteBucketLogging($bucket);
    } catch (OssException $e) {
        printf(__FUNCTION__ . ": FAILED\n");
        printf($e->getMessage() . "\n");

        return;
    }
    print(__FUNCTION__ . ": OK" . "\n");
}
