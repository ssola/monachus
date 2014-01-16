<?php
namespace Monachus\Interfaces;

use Monachus\String as String;

interface NgramParserInterface
{
    public function parse(String $string);
}