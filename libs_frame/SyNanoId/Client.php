<?php
namespace SyNanoId;

class Client
{
    /**
     * Random mode flags
     * @const MODE_NORMAL 1
     * @const MODEL_DYNAMIC 2
     */
    const MODE_NORMAL = 1;
    const MODE_DYNAMIC = 2;
    /**
     * @param string $alphabet Symbols to be used in ID.
     * @param integer $size number of symbols in ID.
     */
    protected $alphabet;
    protected $size;
    /**
     * @var CoreInterface $core Core dynamic random
     */
    private $core;
    /**
     * @var GeneratorInterface $generator Random Btyes Generator
     */
    protected $generator;

    /**
     * Constructor of Client
     * @codeCoverageIgnore
     * @param integer $size
     * @param \SyNanoId\GeneratorInterface|null $generator
     */
    public function __construct($size = 21, GeneratorInterface $generator = null)
    {
        $this->size = $size > 0 ? $size : 21;
        $this->generator = $generator ? : new Generator();
        $this->core = new Core();
        $this->alphabet = CoreInterface::SAFE_SYMBOLS;
    }

    /**
     * Generate nanoid via optional modes
     * @param integer $size
     * @param integer $mode Client::MODE_NORMAL|Client::MODE_DYNAMIC
     * @return string
     */
    public function generateId($size = 0, $mode = self::MODE_NORMAL) : string
    {
        $size = $size > 0 ? $size : $this->size;
        if ($mode == self::MODE_DYNAMIC) {
            return $this->core->random($this->generator, $size, $this->alphabet);
        } else {
            return $this->normalRandom($size);
        }
    }

    /**
     * The original API of nanoid. Use it be careful, Please make sure
     * you have been implements your custom GeneratorInterface as correctly.
     * Otherwise use the build-in default random bytes generator
     * @param string $alphabet default CoreInterface::SAFE_SYMBOLS
     * @param integer $size
     * @param \SyNanoId\GeneratorInterface|null $generator
     * @return string
     */
    public function formattedId(string $alphabet, $size = 0, GeneratorInterface $generator = null) : string
    {
        $alphabet = $alphabet ? : CoreInterface::SAFE_SYMBOLS;
        $size = $size > 0 ? $size : $this->size;
        $generator = $generator ? : $this->generator;

        return $this->core->random($generator, $size, $alphabet);
    }

    /**
     * Backwards-compatible method name.
     * @param string $alphabet
     * @param integer $size
     * @param \SyNanoId\GeneratorInterface|null $generator
     * @return string
     * @since 1.0.0
     */
    public function formatedId(string $alphabet, $size = 0, GeneratorInterface $generator = null) : string
    {
        $size = $size > 0 ? $size : $this->size;

        return $this->formattedId($alphabet, $size, $generator);
    }

    /**
     * Generate secure URL-friendly unique ID.
     * By default, ID will have 21 symbols to have same collisions probability
     * as UUID v4.
     * @see https://github.com/ai/nanoid/blob/master/non-secure/index.js#L19
     * @param integer $size
     * @return string
     */
    private function normalRandom(int $size) : string
    {
        $id = '';
        while (1 <= $size --) {
            $rand = mt_rand() / (mt_getrandmax() + 1);
            $id .= $this->alphabet[intval($rand * 64)];
        }

        return $id;
    }
}
