<?php
namespace SyNanoId;

class Generator implements GeneratorInterface
{
    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function random(int $size)
    {
        return unpack('C*', \random_bytes($size));
    }
}
