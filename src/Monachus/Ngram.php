<?php
namespace Monachus;

class Ngram
{
    private $max = 3;
    private $min = 1;
    private $parser = null;

    public function __construct(Config $config = null)
    {
        if($config)
        {
            $this->max = ($config->max) ? $config->max : $this->max;
            $this->min = ($config->min) ? $config->min : $this->min;
        }
    }

    public function setParser(Interfaces\NgramParserInterface $parser)
    {
        $this->parser = $parser;
    }

    public function parse(String $string)
    {
        if(!$this->parser)
            $this->parser = new Ngram\Parsers\Generic(); // load default adapter

        return $this->parser->parse($string, $this->max);
    }
}