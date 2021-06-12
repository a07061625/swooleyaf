<?php
require_once __DIR__ . '/helper_load.php';

/**
 * @throws \SyException\Image\ImageException
 */
function handleImageBlur(SyImage\Filter &$filter)
{
    $blur = (int)\SyTool\Tool::getClientOption('-blur', false, 0);
    $filter->handleBlur($blur);
}

/**
 * @throws \SyException\Image\ImageException
 */
function handleImageBrightness(SyImage\Filter &$filter)
{
    $brightness = (int)\SyTool\Tool::getClientOption('-brightness', false, 0);
    $filter->handleBrightness($brightness);
}

/**
 * @throws \SyException\Image\ImageException
 */
function handleImageColorize(SyImage\Filter &$filter)
{
    $red = (int)\SyTool\Tool::getClientOption('-red', false, 0);
    $green = (int)\SyTool\Tool::getClientOption('-green', false, 0);
    $blue = (int)\SyTool\Tool::getClientOption('-blue', false, 0);
    $filter->handleColorize($red, $green, $blue);
}

/**
 * @throws \SyException\Image\ImageException
 */
function handleImageContrast(SyImage\Filter &$filter)
{
    $contrast = (int)\SyTool\Tool::getClientOption('-contrast', false, 0);
    $filter->handleContrast($contrast);
}

/**
 * @throws \SyException\Image\ImageException
 */
function handleImageDither(SyImage\Filter &$filter)
{
    $type = (string)\SyTool\Tool::getClientOption('-type', false, '');
    $filter->handleDither($type);
}

/**
 * @throws \SyException\Image\ImageException
 */
function handleImageGamma(SyImage\Filter &$filter)
{
    $gamma = (float)\SyTool\Tool::getClientOption('-gamma', false, 1.0);
    $filter->handleGamma($gamma);
}

/**
 * @throws \Exception
 */
function handleImageGrayscale(SyImage\Filter &$filter)
{
    $filter->handleGrayscale();
}

/**
 * @throws \Exception
 */
function handleImageInvert(SyImage\Filter &$filter)
{
    $filter->handleInvert();
}

/**
 * @throws \SyException\Image\ImageException
 */
function handleImagePixelate(SyImage\Filter &$filter)
{
    $pixel = (int)\SyTool\Tool::getClientOption('-pixel', false, 1);
    $filter->handlePixelate($pixel);
}

/**
 * @throws \SyException\Image\ImageException
 */
function handleImageSharpen(SyImage\Filter &$filter)
{
    $sharpen = (int)\SyTool\Tool::getClientOption('-sharpen', false, 1);
    $filter->handleSharpen($sharpen);
}

/**
 * @throws \Exception
 */
function handleImageSobel(SyImage\Filter &$filter)
{
    $filter->handleSobel();
}

/**
 * @throws \SyException\Image\ImageException
 */
function handleImageResizeFit(SyImage\Filter &$filter)
{
    $width = (int)\SyTool\Tool::getClientOption('-width', false, 0);
    $height = (int)\SyTool\Tool::getClientOption('-height', false, 0);
    $filter->handleResizeFit($width, $height);
}

/**
 * @throws \SyException\Image\ImageException
 */
function handleImageResizeExact(SyImage\Filter &$filter)
{
    $width = (int)\SyTool\Tool::getClientOption('-width', false, 0);
    $height = (int)\SyTool\Tool::getClientOption('-height', false, 0);
    $filter->handleResizeExact($width, $height);
}

/**
 * @throws \SyException\Image\ImageException
 */
function handleImageResizeFill(SyImage\Filter &$filter)
{
    $width = (int)\SyTool\Tool::getClientOption('-width', false, 0);
    $height = (int)\SyTool\Tool::getClientOption('-height', false, 0);
    $filter->handleResizeFill($width, $height);
}

/**
 * @throws \SyException\Image\ImageException
 */
function handleImageResizeExactWidth(SyImage\Filter &$filter)
{
    $width = (int)\SyTool\Tool::getClientOption('-width', false, 0);
    $filter->handleResizeExactWidth($width);
}

/**
 * @throws \SyException\Image\ImageException
 */
function handleImageResizeExactHeight(SyImage\Filter &$filter)
{
    $height = (int)\SyTool\Tool::getClientOption('-height', false, 0);
    $filter->handleResizeExactHeight($height);
}

function handleImageFlatten(SyImage\Filter &$filter)
{
    $filter->handleFlatten();
}

/**
 * @throws \SyException\Image\ImageException
 */
function handleImageBlend(SyImage\Filter &$filter)
{
    $blend = (string)\SyTool\Tool::getClientOption('-blend', false, '');
    $filter->handleBlend($blend, [
        'mode_type' => (string)\SyTool\Tool::getClientOption('-mode', false, 'normal'),
        'position_type' => (string)\SyTool\Tool::getClientOption('-position', false, 'center'),
        'opacity' => (float)\SyTool\Tool::getClientOption('-opacity', false, 1.0),
        'offset_x' => (int)\SyTool\Tool::getClientOption('-x', false, 0),
        'offset_y' => (int)\SyTool\Tool::getClientOption('-y', false, 0),
    ]);
}

/**
 * @throws \SyException\Image\ImageException
 */
function handleImageRotate(SyImage\Filter &$filter)
{
    $angle = (int)\SyTool\Tool::getClientOption('-angle', false, 0);
    $color = (string)\SyTool\Tool::getClientOption('-color', false, '');
    $filter->handleRotate($angle, $color);
}

/**
 * @throws \SyException\Image\ImageException
 */
function handleImageText(SyImage\Filter &$filter)
{
    $text = (string)\SyTool\Tool::getClientOption('-text', false, '');
    $filter->handleText($text, [
        'size' => (int)\SyTool\Tool::getClientOption('-size', false, 12),
        'offset_x' => (int)\SyTool\Tool::getClientOption('-x', false, 0),
        'offset_y' => (int)\SyTool\Tool::getClientOption('-y', false, 12),
        'color' => (string)\SyTool\Tool::getClientOption('-color', false, '000000'),
        'font' => (string)\SyTool\Tool::getClientOption('-font', false, ''),
        'angle' => (int)\SyTool\Tool::getClientOption('-angle', false, 0),
    ]);
}

$handleType = \SyTool\Tool::getClientOption(1, true, '');
$funcName = 'handleImage' . $handleType;
if (!function_exists($funcName)) {
    echo '处理类型不支持' . PHP_EOL;
    exit(1);
}

$mainImage = \SyTool\Tool::getClientOption('-main', false, '');
if (!is_file($mainImage)) {
    echo '主图不合法' . PHP_EOL;
    exit(2);
}

$filter = new \SyImage\Filter($mainImage);
$funcName($filter);
$filter->save();
