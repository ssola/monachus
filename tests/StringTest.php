<?php
class StringTest extends PHPUnit_Framework_TestCase
{
    public function testCreateNewString()
    {
        $string = new Monachus\String("Hello World");

        $this->assertInstanceOf("Monachus\String", $string);
        $this->assertEquals($string, "Hello World");
    }

    public function testStringIsUTF8()
    {
        $string = new Monachus\String("洋側を中");
        $this->assertEquals($string->getCharset(), "UTF-8");
    }

    public function testStringPrintCorrectly()
    {
        $string = new Monachus\String("洋側を中");
        $this->assertEquals($string, "洋側を中");
    }

    public function testCalculateLength()
    {
        $string = new Monachus\String("This is a text");
        $this->assertEquals($string->length(), 14);

        // test as well with other languages like japanese or arabic
        $stringJp = new Monachus\String("きょう（16日）は太平洋側を中心に晴れた所が多いが、最高気温は平年並みから平年より低くなった。東京では9.1℃と1週間連続で10℃を下回っている。この全国的な厳しい寒さは週末にかけて続き");
        $this->assertEquals($stringJp->length(), 93);

        // even chinese
        $stringCn = new Monachus\String("请收藏我们的网址");
        $this->assertEquals($stringCn->length(), 8);

        // and some arabic as well...
        $stringAr = new Monachus\String("لمرزمجحف");
        $this->assertEquals($stringAr->length(), 8);
    }

    public function testSubstraction()
    {
        $string = new Monachus\String("This is a text");
        $this->assertEquals($string->substract(3, 5), "s is ");

        // test as well with other languages like japanese or arabic
        $stringJp = new Monachus\String("きょう（16日）は太平洋側を中心に晴れた所が多いが、最高気温は平年並みから平年より低くなった。東京では9.1℃と1週間連続で10℃を下回っている。この全国的な厳しい寒さは週末にかけて続き");
        $this->assertEquals($stringJp->substract(4, 3), "16日");     
    }

    public function testFindInEnglishText()
    {
        $string = new Monachus\String("Hello World, I am surprised to be here today!");
        $this->assertEquals($string->find(new Monachus\String("World")), 6);
    }

    public function testFindTextNotExistsInString()
    {
        $string = new Monachus\String("Hello World, I am surprised to be here today!");
        $this->assertEquals($string->find(new Monachus\String("BLAHBLAH BLAH")), false);        
    }

    public function testFindInJapanaseText()
    {
        $stringJp = new Monachus\String("きょう（16日）は太平洋側を中心に晴れた所が多いが、最高気温は平年並みから平年より低くなった。東京では9.1℃と1週間連続で10℃を下回っている。この全国的な厳しい寒さは週末にかけて続き");
        $this->assertEquals($stringJp->find(new Monachus\String("平洋側")), 10);
    }
}