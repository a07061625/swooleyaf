<?php
/**
 * 自动化生成类文件
 * User: 姜伟
 * Date: 2021/8/10 0010
 * Time: 17:52
 */
global $argv;
$productName = $argv[1] ?? '';
if (!ctype_alnum($productName)) {
    exit('产品名称不合法');
}

$fileName = __DIR__ . '/' . $productName . '/' . $productName . 'ApiResolver.php';
if (!file_exists($fileName)) {
    exit($productName . '产品API文件不存在');
}

$classDoc = '';
$classContent = '';
$className = '';
$file = fopen($fileName, 'r');
while (!feof($file)) {
    $fileContent = fgets($file);
    $prefix = trim(substr($fileContent, 0, 3));
    if ('/**' == $prefix) {
        $classDoc = $fileContent;
    } elseif (('*' == $prefix) || ('*/' == $prefix)) {
        $classDoc .= $fileContent;
    } elseif (strlen($className) > 0) {
        if ('}' == substr($fileContent, 0, 1)) {
            $outputFile = __DIR__ . '/' . $productName . '/' . $className . '.php';
            if (is_int(strpos($className, 'ApiResolver'))) {
                $className = '';

                continue;
            }

            $classContent .= $fileContent;
            $className = '';
            file_put_contents($outputFile, $classContent);
        } else {
            $classContent .= $fileContent;
        }
    } else {
        $matches = [];
        preg_match('/^class\s+([0-9a-zA-Z]+)/', $fileContent, $matches);
        if (!empty($matches)) {
            $className = $matches[1];
            $classContent = '<?php' . PHP_EOL . PHP_EOL;
            $classContent .= 'namespace AlibabaCloud\\' . $productName . ';' . PHP_EOL . PHP_EOL;
            if (strlen($classDoc) > 0) {
                $classContent .= $classDoc;
                $classDoc = '';
            }
            $classContent .= $fileContent;
        }
    }
}
fclose($file);
unlink($fileName);
