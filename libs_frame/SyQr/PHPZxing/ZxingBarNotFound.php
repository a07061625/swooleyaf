<?php
/*
Descrition : ZxingBarNotFound - returns the obejct of ZxingBarNotFound if any bar / Qr Code is
not found

license: MIT-style

authors:
- Siddharth Deshpande (dsiddharth2@gmail.com)
...
* PHPZxing
* Version 1.0.1
* Copyright (c) 2018 Siddharth Deshpande
*
* Permission is hereby granted, free of charge, to any person
* obtaining a copy of this software and associated documentation
* files (the "Software"), to deal in the Software without
* restriction, including without limitation the rights to use,
* copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the
* Software is furnished to do so, subject to the following
* conditions:
*
* The above copyright notice and this permission notice shall be
* included in all copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
* EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
* OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
* NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
* HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
* WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
* FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
* OTHER DEALINGS IN THE SOFTWARE.
*/
namespace SyQr\PHPZxing;

class ZxingBarNotFound implements PHPZxingInterface
{
    // Path of the image decoded
    private $imagePath = null;
    // Error Code of the image
    private $imageErrorCode = null;
    // Message of error
    private $message = null;

    public function __construct($imagePath, $imageErrorCode, $message)
    {
        $this->imagePath = $imagePath;
        $this->imageErrorCode = $imageErrorCode;
        $this->message = $message;
    }

    public function getImagePath()
    {
        return $this->imagePath;
    }

    public function getImageErrorCode()
    {
        return $this->imageErrorCode;
    }

    public function getErrorMessage()
    {
        return $this->message;
    }

    public function isFound()
    {
        return false;
    }
}
