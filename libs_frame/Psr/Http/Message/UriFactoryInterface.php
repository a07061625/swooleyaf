<?php

namespace Psr\Http\Message;

interface UriFactoryInterface
{
    /**
     * Create a new URI.
     *
     * @throws \InvalidArgumentException if the given URI cannot be parsed
     */
    public function createUri(string $uri = ''): UriInterface;
}
