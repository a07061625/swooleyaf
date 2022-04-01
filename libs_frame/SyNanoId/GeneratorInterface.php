<?php
namespace SyNanoId;

interface GeneratorInterface
{
    /**
     * Return random bytes array
     * @param integer $size
     * @return array
     */
    public function random(int $size);
}
