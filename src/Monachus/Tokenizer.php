<?php
namespace Monachus;

class Tokenizer
{
    private $tokenizer = null;

    public function __construct(Interfaces\TokenizerInterface $tokenizer = null)
    {
        $this->tokenizer = $tokenizer; 
    }

    public function tokenize(String $string)
    {
        if ($this->tokenizer == null)
            $this->tokenizer = new Tokenizers\Generic();
        
        return $this->tokenizer->tokenize($string);
    }
}