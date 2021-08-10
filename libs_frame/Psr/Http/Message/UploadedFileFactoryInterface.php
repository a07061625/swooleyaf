<?php

namespace Psr\Http\Message;

interface UploadedFileFactoryInterface
{
    /**
     * Create a new uploaded file.
     * If a size is not provided it will be determined by checking the size of
     * the file.
     *
     * @see http://php.net/manual/features.file-upload.post-method.php
     * @see http://php.net/manual/features.file-upload.errors.php
     *
     * @param StreamInterface $stream          underlying stream representing the
     *                                         uploaded file content
     * @param null|int        $size            in bytes
     * @param int             $error           PHP file upload error
     * @param null|string     $clientFilename  filename as provided by the client, if any
     * @param null|string     $clientMediaType media type as provided by the client, if any
     *
     * @throws \InvalidArgumentException if the file resource is not readable
     */
    public function createUploadedFile(
        StreamInterface $stream,
        ?int $size = null,
        int $error = \UPLOAD_ERR_OK,
        ?string $clientFilename = null,
        ?string $clientMediaType = null
    ): UploadedFileInterface;
}
