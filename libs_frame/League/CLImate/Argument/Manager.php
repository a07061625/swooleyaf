<?php

namespace League\CLImate\Argument;

use League\CLImate\CLImate;
use League\CLImate\Exceptions\InvalidArgumentException;

class Manager
{
    /**
     * An array of arguments passed to the program.
     *
     * @var Argument[]
     */
    protected $arguments = [];

    /**
     * A program's description.
     *
     * @var string
     */
    protected $description;

    /**
     * Filter class to find various types of arguments
     *
     * @var \League\CLImate\Argument\Filter
     */
    protected $filter;

    /**
     * Summary builder class
     *
     * @var \League\CLImate\Argument\Summary
     */
    protected $summary;

    /**
     * Argument parser class
     *
     * @var \League\CLImate\Argument\Parser
     */
    protected $parser;

    public function __construct()
    {
        $this->filter = new Filter();
        $this->summary = new Summary();
        $this->parser = new Parser();
    }

    /**
     * Add an argument.
     *
     * @param Argument|array|string $argument
     * @param $options
     *
     * @throws InvalidArgumentException if $argument isn't an array or Argument object
     */
    public function add($argument, array $options = [])
    {
        if (\is_array($argument)) {
            $this->addMany($argument);

            return;
        }

        if (\is_string($argument)) {
            $argument = Argument::createFromArray($argument, $options);
        }

        if (!$argument instanceof Argument) {
            throw new InvalidArgumentException('Please provide an argument name or object.');
        }

        $this->arguments[$argument->name()] = $argument;
    }

    /**
     * Determine if an argument exists.
     *
     * @param string $name
     *
     * @return bool
     */
    public function exists($name)
    {
        return isset($this->arguments[$name]);
    }

    /**
     * Retrieve an argument's value.
     *
     * @param string $name
     *
     * @return null|bool|float|int|string
     */
    public function get($name)
    {
        return isset($this->arguments[$name]) ? $this->arguments[$name]->value() : null;
    }

    /**
     * Retrieve an argument's all values as an array.
     *
     * @param string $name
     *
     * @return bool[]|float[]|int[]|string[]
     */
    public function getArray($name)
    {
        return isset($this->arguments[$name]) ? $this->arguments[$name]->values() : [];
    }

    /**
     * Retrieve all arguments.
     *
     * @return Argument[]
     */
    public function all()
    {
        return $this->arguments;
    }

    /**
     * Determine if an argument has been defined on the command line.
     *
     * This can be useful for making sure an argument is present on the command
     * line before parse()'ing them into argument objects.
     *
     * @param string $name
     * @param array  $argv
     *
     * @return bool
     */
    public function defined($name, ?array $argv = null)
    {
        // The argument isn't defined if it's not defined by the calling code.
        if (!$this->exists($name)) {
            return false;
        }

        $argument = $this->arguments[$name];
        $command_arguments = $this->parser->arguments($argv);

        foreach ($command_arguments as $command_argument) {
            if ($this->isArgument($argument, $command_argument)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Retrieve all arguments as key/value pairs.
     *
     * @return array
     */
    public function toArray()
    {
        $return = [];

        foreach ($this->all() as $name => $argument) {
            $return[$name] = $argument->value();
        }

        return $return;
    }

    /**
     * Set a program's description.
     *
     * @param string $description
     */
    public function description($description)
    {
        $this->description = trim($description);
    }

    /**
     * Output a script's usage statement.
     *
     * @param array $argv
     */
    public function usage(CLImate $climate, ?array $argv = null)
    {
        $this->summary
            ->setClimate($climate)
            ->setDescription($this->description)
            ->setCommand($this->parser->command($argv))
            ->setFilter($this->filter, $this->all())
            ->output();
    }

    /**
     * Parse command line arguments into CLImate arguments.
     *
     * @param array $argv
     */
    public function parse(?array $argv = null)
    {
        $this->parser->setFilter($this->filter, $this->all());

        $this->parser->parse($argv);
    }

    /**
     * Get the trailing arguments
     *
     * @return null|string
     */
    public function trailing()
    {
        return $this->parser->trailing();
    }

    /**
     * Get the trailing arguments as an array
     *
     * @return null|array
     */
    public function trailingArray()
    {
        return $this->parser->trailingArray();
    }

    /**
     * Add multiple arguments to a CLImate script.
     */
    protected function addMany(array $arguments = [])
    {
        foreach ($arguments as $name => $options) {
            $this->add($name, $options);
        }
    }

    /**
     * Check if the defined argument matches the command argument.
     *
     * @param Argument $argument
     * @param string   $command_argument
     *
     * @return bool
     */
    protected function isArgument($argument, $command_argument)
    {
        $possibilities = [
            $argument->prefix() => "-{$argument->prefix()}",
            $argument->longPrefix() => "--{$argument->longPrefix()}",
        ];

        foreach ($possibilities as $key => $search) {
            if ($key && 0 === strpos($command_argument, $search)) {
                return true;
            }
        }

        return false;
    }
}
