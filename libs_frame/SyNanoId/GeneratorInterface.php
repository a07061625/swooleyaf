<?php

namespace SyNanoId;

interface GeneratorInterface
{
    /**
     * Return random bytes array
     *
     * @return array
     */
    public function random(int $size);
}
