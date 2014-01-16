<?php
class StringTest extends PHPUnit_Framework_TestCase
{
    public function testCreateNewString()
    {
        $string = new Monachus\String("Hello World");

        $this->assertInstanceOf("Monachus\String", $string);
        $this->assertEquals("Hello World",$string);
    }

    public function testStringIsUTF8()
    {
        $string = new Monachus\String("洋側を中");
        $this->assertEquals("UTF-8", $string->getCharset());
    }

    public function testStringPrintCorrectly()
    {
        $string = new Monachus\String("洋側を中");
        $this->assertEquals("洋側を中", $string);
    }

    public function testCalculateLength()
    {
        $string = new Monachus\String("This is a text");
        $this->assertEquals(14, $string->length());

        // test as well with other languages like japanese or arabic
        $stringJp = new Monachus\String("きょう（16日）は太平洋側を中心に晴れた所が多いが、最高気温は平年並みから平年より低くなった。東京では9.1℃と1週間連続で10℃を下回っている。この全国的な厳しい寒さは週末にかけて続き");
        $this->assertEquals(93, $stringJp->length());

        // even chinese
        $stringCn = new Monachus\String("请收藏我们的网址");
        $this->assertEquals(8, $stringCn->length());

        // and some arabic as well...
        $stringAr = new Monachus\String("لمرزمجحف");
        $this->assertEquals(8, $stringAr->length());
    }

    public function testSubstraction()
    {
        $string = new Monachus\String("This is a text");
        $this->assertEquals("s is ", $string->substract(3, 5));

        // test as well with other languages like japanese or arabic
        $stringJp = new Monachus\String("きょう（16日）は太平洋側を中心に晴れた所が多いが、最高気温は平年並みから平年より低くなった。東京では9.1℃と1週間連続で10℃を下回っている。この全国的な厳しい寒さは週末にかけて続き");
        $this->assertEquals("16日", $stringJp->substract(4, 3));     
    }

    public function testFindInEnglishText()
    {
        $string = new Monachus\String("Hello World, I am surprised to be here today!");
        $this->assertEquals(6, $string->find(new Monachus\String("World")));
    }

    public function testFindTextNotExistsInString()
    {
        $string = new Monachus\String("Hello World, I am surprised to be here today!");
        $this->assertEquals(false, $string->find(new Monachus\String("BLAHBLAH BLAH")));        
    }

    public function testFindInJapanaseText()
    {
        $stringJp = new Monachus\String("きょう（16日）は太平洋側を中心に晴れた所が多いが、最高気温は平年並みから平年より低くなった。東京では9.1℃と1週間連続で10℃を下回っている。この全国的な厳しい寒さは週末にかけて続き");
        $this->assertEquals(10, $stringJp->find(new Monachus\String("平洋側")));
    }

    public function testStringToLowerCase()
    {
        $string = new Monachus\String("This is a text");
        $this->assertEquals("this is a text", $string->toLowercase());
    }

    public function testStringToUpperCase()
    {
        $string = new Monachus\String("This is a text!!");
        $this->assertEquals("THIS IS A TEXT!!", $string->toUppercase());
    }    

    public function testRussianStringToUpperCase()
    {
        $string = new Monachus\String("Новости");
        $this->assertEquals( "НОВОСТИ", $string->toUppercase());
    }

    public function testRussianStringToLowerCase()
    {
        $string = new Monachus\String("Новости");
        $this->assertEquals("новости", $string->toLowercase());
    }     
}