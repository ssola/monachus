<?php
class TokenizerTest extends PHPUnit_Framework_TestCase
{
    public function testCreateInstanceOfTokenizer()
    {
        $tokenizer = new Monachus\Tokenizer();
        $this->assertInstanceOf("Monachus\Tokenizer", $tokenizer);
    }

    public function testCreateInstanceOfTokenizerWithSpecificAdapter()
    {
        $tokenizer = new Monachus\Tokenizer(new Monachus\Tokenizers\Japanase());
        $this->assertInstanceOf("Monachus\Tokenizer", $tokenizer);        
    }

    public function testTokenizeSimpleEnglishText()
    {
        $text = new Monachus\String("This is a simple text, written in English.");

        $tokenizer = new Monachus\Tokenizer();
        $tokenized = $tokenizer->tokenize($text);

        $this->assertEquals(8, count($tokenized));
    }

    public function testTokenizeEmptyString()
    {
        $text = new Monachus\String();
        $tokenizer = new Monachus\Tokenizer();

        $tokenized = $tokenizer->tokenize($text);

        $this->assertEquals(0, count($tokenized));
    }

    public function testTokenizeJapanaseAdapterEmptyString()
    {
        $text = new Monachus\String();
        $tokenizer = new Monachus\Tokenizer(new Monachus\Tokenizers\Japanase());

        $tokenized = $tokenizer->tokenize($text);

        $this->assertEquals(0, count($tokenized));
    }    

    public function testTokenizeJapanaseString()
    {
        $text = new Monachus\String("きょう（16日）は太平洋側を中心に晴れた所が多いが、最高気温は平年並みから平年より低くなった");
        $tokenizer = new Monachus\Tokenizer(new Monachus\Tokenizers\Japanase());
        $tokenized = $tokenizer->tokenize($text);
        $this->assertEquals(25, count($tokenized));
    }

    public function testTokenizeLongText()
    {
        $text = new Monachus\String("Bei der Zerlegung einer Eingabe in eine Folge von logisch zusammengehörigen Einheiten, in die so genannten Token, spricht man auch von lexikalischer Analyse. Typischerweise geschieht die Zerlegung nach den Regeln einer regulären Grammatik, und der Tokenizer ist als endlicher Automat realisiert. Ein Verfahren zur Überführung eines regulären Ausdrucks in einen endlichen Automaten ist das Berry-Sethi-Verfahren.
Ein Tokenizer ist Bestandteil eines Parsers und von vorverarbeitender Funktion. Er erkennt innerhalb der Eingabe Schlüsselwörter, Bezeichner, Operatoren und Konstanten. Diese bestehen aus mehreren Zeichen, bilden aber eine logische Einheit, sogenannte Token. Erkannte Token werden mit ihrem jeweiligen Typ zurückgeliefert. Token sind für den Parser sozusagen die atomaren Einheiten, die er verarbeiten können muss und werden deshalb auch Terminalsymbole genannt.
Ein Tokenizer kann einen separaten, sogenannten Screener benutzen, um Leerraum und Kommentare zu entfernen und so die lexigrafische Analyse der Eingabedaten vereinfachen. Dies muss jedoch von der zugrunde liegenden Grammatik abgedeckt sein.
Mittels erweiterte Backus-Naur-Form (EBNF) kann ein Tokenizer formal spezifiziert werden.");

        $tokenizer = new Monachus\Tokenizer();
        $tokenized = $tokenizer->tokenize($text);

        $this->assertEquals(161, count($tokenized));        
    }
}