<?php
namespace Grafika;

/**
 * Hold and computes position of objects added to canvas.
 *
 * @package Grafika
 */
class Position
{
    /**
     * Top left of the canvas.
     */
    const TOP_LEFT = 'top-left';
    /**
     * Top center of the canvas.
     */
    const TOP_CENTER = 'top-center';
    /**
     * Top right of the canvas.
     */
    const TOP_RIGHT = 'top-right';
    /**
     * Center left of the canvas.
     */
    const CENTER_LEFT = 'center-left';
    /**
     * Center of the canvas.
     */
    const CENTER = 'center';
    /**
     * Center right of the canvas.
     */
    const CENTER_RIGHT = 'center-right';
    /**
     * Center left of the canvas.
     */
    const BOTTOM_LEFT = 'bottom-left';
    /**
     * Bottom center of the canvas.
     */
    const BOTTOM_CENTER = 'bottom-center';
    /**
     * Bottom right of the canvas.
     */
    const BOTTOM_RIGHT = 'bottom-right';

    /**
     * @var string holds position in human-readable text
     */
    private $position;
    /**
     * @var int Number of pixels to the left of the origin
     */
    private $offsetX;
    /**
     * @var int number of pixels to the bottom of the origin
     */
    private $offsetY;

    /**
     * Position constructor.
     *
     * @param string $position defaults to center
     * @param int    $offsetX  defaults to 0
     * @param int    $offsetY  defaults to 0
     */
    public function __construct($position = 'center', $offsetX = 0, $offsetY = 0)
    {
        $this->position = $position;
        $this->offsetX = $offsetX;
        $this->offsetY = $offsetY;
    }

    /**
     * Translate the textual position + offsets into x,y values.
     *
     * @param int $canvasWidth  width of canvas
     * @param int $canvasHeight height of canvas
     * @param int $imageWidth   width of image/object added
     * @param int $imageHeight  height of image/object added
     *
     * @return array array of X and Y coordinates: array($x, $y)
     *
     * @throws \Exception when invalid position
     */
    public function getXY($canvasWidth, $canvasHeight, $imageWidth, $imageHeight)
    {
        if (self::TOP_LEFT === $this->position) {
            $x = 0;
            $y = 0;
        } elseif (self::TOP_CENTER === $this->position) {
            $x = (int)round(($canvasWidth / 2) - ($imageWidth / 2));
            $y = 0;
        } elseif (self::TOP_RIGHT === $this->position) {
            $x = $canvasWidth - $imageWidth;
            $y = 0;
        } elseif (self::CENTER_LEFT === $this->position) {
            $x = 0;
            $y = (int)round(($canvasHeight / 2) - ($imageHeight / 2));
        } elseif (self::CENTER_RIGHT === $this->position) {
            $x = $canvasWidth - $imageWidth;
            $y = (int)round(($canvasHeight / 2) - ($imageHeight / 2));
        } elseif (self::BOTTOM_LEFT === $this->position) {
            $x = 0;
            $y = $canvasHeight - $imageHeight;
        } elseif (self::BOTTOM_CENTER === $this->position) {
            $x = (int)round(($canvasWidth / 2) - ($imageWidth / 2));
            $y = $canvasHeight - $imageHeight;
        } elseif (self::BOTTOM_RIGHT === $this->position) {
            $x = $canvasWidth - $imageWidth;
            $y = $canvasHeight - $imageHeight;
        } elseif (self::CENTER === $this->position) {
            $x = (int)round(($canvasWidth / 2) - ($imageWidth / 2));
            $y = (int)round(($canvasHeight / 2) - ($imageHeight / 2));
        } else {
            throw new \Exception(sprintf('Invalid position "%s".', $this->position));
        }

        return [
            $x + $this->offsetX,
            $y + $this->offsetY
        ];
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->position;
    }

    /**
     * @return int
     */
    public function getOffsetY()
    {
        return $this->offsetY;
    }

    /**
     * @return int
     */
    public function getOffsetX()
    {
        return $this->offsetX;
    }
}
