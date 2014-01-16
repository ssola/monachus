<?php
class NgramTest extends PHPUnit_Framework_TestCase
{
    public function testCreateInstanceOfNgram()
    {
        $ngram = new Monachus\Ngram();
        $this->assertInstanceOf("Monachus\Ngram", $ngram);
    }

    public function testSetConfigToNgramInstance()
    {
        $config = new Monachus\Config();
        $config->max = 3;
        $config->min = 1;

        $ngram = new Monachus\Ngram();
        $this->assertInstanceOf("Monachus\Ngram", $ngram);
    }

    public function testSetParserAdapterToNgramInstance()
    {
        $ngram = new Monachus\Ngram();
        $ngram->setParser(new Monachus\Ngram\Parsers\Generic());

        $this->assertInstanceOf("Monachus\Ngram", $ngram);
    }

    public function testCreateNgramLevelThreeSimpleWord()
    {
        $word = new Monachus\String("Hello");

        $config = new Monachus\Config();
        $config->max = 3;

        $ngram = new Monachus\Ngram();
        $ngrams = $ngram->parse($word);

        $expectedResult = array(
            "hel" => array("count" => 1),
            "ell" => array("count" => 1),
            "llo" => array("count" => 1),
        );
        
        $this->assertEquals($ngrams, $expectedResult);
    }

    public function testCreateNgramLevelThreeSimpleSentence()
    {
        $word = new Monachus\String("Hello World!");

        $config = new Monachus\Config();
        $config->max = 3;

        $ngram = new Monachus\Ngram();
        $ngrams = $ngram->parse($word);

        $expectedResult = array(
            "hel" => array("count" => 1),
            "ell" => array("count" => 1),
            "llo" => array("count" => 1),
            "lo_" => array("count" => 1),
            "o_w" => array("count" => 1),
            "_wo" => array("count" => 1),
            "wor" => array("count" => 1),
            "orl" => array("count" => 1),
            "rld" => array("count" => 1),
            "ld!" => array("count" => 1),
        );
        
        $this->assertEquals($ngrams, $expectedResult);       
    }

    public function testCreateNgramLevelThreeWithRussianWord()
    {
        $word = new Monachus\String("Новости");

        $config = new Monachus\Config();
        $config->max = 3;

        $ngram = new Monachus\Ngram();
        $ngrams = $ngram->parse($word);

        $expectedResult = array(
            "нов" => array("count" => 1),
            "ово" => array("count" => 1),
            "вос" => array("count" => 1),
            "ост" => array("count" => 1),
            "сти" => array("count" => 1)
        );
        
        $this->assertEquals($ngrams, $expectedResult);        
    }

    public function testCreateNgramLevelThreeWithJapanaseWord()
    {
        $word = new Monachus\String("1時36分更新");

        $config = new Monachus\Config();
        $config->max = 3;

        $ngram = new Monachus\Ngram();
        $ngrams = $ngram->parse($word);

        $expectedResult = array(
            "1時3" => array("count" => 1),
            "時36" => array("count" => 1),
            "36分" => array("count" => 1),
            "6分更" => array("count" => 1),
            "分更新" => array("count" => 1)
        );
        
        $this->assertEquals($ngrams, $expectedResult);        
    }    
}