<?php

use Codeception\Test\Unit;
use gyaani\guy\Classes\HtmlNormalizer;

class HtmlNormalizerTest extends Unit
{

    /**
     * @var HtmlNormalizer
     */
    private $htmlNormalizer;

    private function setupClass()
    {
        $this->htmlNormalizer = new HtmlNormalizer();
    }

    public function testSetByValue()
    {
        $this->setupClass();
        $name = 'acol';
        $this->htmlNormalizer->setByValue([$name, 'int'], 55.55);
        self::assertSame(55, $this->htmlNormalizer->extractedValues[$name]);

        $this->htmlNormalizer->setByValue([$name, 'int'], 55);
        self::assertSame(55, $this->htmlNormalizer->extractedValues[$name]);

        $this->htmlNormalizer->setByValue([$name, 'int'], 'd55');
        self::assertSame(55, $this->htmlNormalizer->extractedValues[$name]);

        $this->htmlNormalizer->setByValue([$name, 'int'], ' 455 ');
        self::assertSame(455, $this->htmlNormalizer->extractedValues[$name]);

        $this->htmlNormalizer->setByValue([$name, 'int'], '  ₹ 9,499.00

(inc GST)  ');
        self::assertSame(9499, $this->htmlNormalizer->extractedValues[$name]);

        $this->htmlNormalizer->setByValue([$name, 'int'], 'text');
        self::assertSame('', $this->htmlNormalizer->extractedValues[$name]);

        $this->htmlNormalizer->setByValue([$name, 'tinyint'], '  ');
        self::assertSame(0, $this->htmlNormalizer->extractedValues[$name]);

        $this->htmlNormalizer->setByValue([$name, 'tinyInt'], ' d');
        self::assertSame(1, $this->htmlNormalizer->extractedValues[$name]);

        $this->htmlNormalizer->setByValue([$name, 'tinyInt'], '');
        self::assertSame(0, $this->htmlNormalizer->extractedValues[$name]);

        $this->htmlNormalizer->setByValue([$name, 'float'], 55.55);
        self::assertSame(55.55, $this->htmlNormalizer->extractedValues[$name]);

        $this->htmlNormalizer->setByValue([$name, 'float'], 55);
        self::assertSame(55.0, $this->htmlNormalizer->extractedValues[$name]);

        $this->htmlNormalizer->setByValue([$name, 'float'], 'd55.5');
        self::assertSame(55.5, $this->htmlNormalizer->extractedValues[$name]);

        $this->htmlNormalizer->setByValue([$name, 'float'], ' 4.455 ');
        self::assertSame(4.455, $this->htmlNormalizer->extractedValues[$name]);

        $this->htmlNormalizer->setByValue([$name, 'float'], 'text');
        self::assertSame('', $this->htmlNormalizer->extractedValues[$name]);

        $this->htmlNormalizer->setByValue([$name, 'double'], 55.55);
        self::assertSame(55.55, $this->htmlNormalizer->extractedValues[$name]);

        $this->htmlNormalizer->setByValue([$name, 'double'], 55);
        self::assertSame(55.0, $this->htmlNormalizer->extractedValues[$name]);

        $this->htmlNormalizer->setByValue([$name, 'double'], 'd55.5');
        self::assertSame(55.5, $this->htmlNormalizer->extractedValues[$name]);

        $this->htmlNormalizer->setByValue([$name, 'double'], ' 4.455 ');
        self::assertSame(4.455, $this->htmlNormalizer->extractedValues[$name]);

        $this->htmlNormalizer->setByValue([$name, 'double'], 'text');
        self::assertSame('', $this->htmlNormalizer->extractedValues[$name]);

        $this->htmlNormalizer->setByValue([$name, 'string'], 'text');
        self::assertSame('text', $this->htmlNormalizer->extractedValues[$name]);
        $this->htmlNormalizer->setByValue([$name, 'string'], 'text34');
        self::assertSame('text34', $this->htmlNormalizer->extractedValues[$name]);
        $this->htmlNormalizer->setByValue([$name, 'string'], 'tex.dft');
        self::assertSame('tex.dft', $this->htmlNormalizer->extractedValues[$name]);
        $this->htmlNormalizer->setByValue([$name, 'string'], 'text<span></span>span>');
        self::assertSame('text<span></span>span>', $this->htmlNormalizer->extractedValues[$name]);
        $this->htmlNormalizer->setByValue([$name, 'string'], '433.3');
        self::assertSame('433.3', $this->htmlNormalizer->extractedValues[$name]);
        $this->htmlNormalizer->setByValue([$name, 'string'], '');
        self::assertSame('', $this->htmlNormalizer->extractedValues[$name]);
        $this->htmlNormalizer->setByValue([$name, 'string'], '!!!@sdsd.2f');
        self::assertSame('!!!@sdsd.2f', $this->htmlNormalizer->extractedValues[$name]);
        $this->htmlNormalizer->setByValue([$name, 'string'], '0');
        self::assertSame('0', $this->htmlNormalizer->extractedValues[$name]);
        $this->htmlNormalizer->setByValue([$name, 'string'], 45);
        self::assertSame('45', $this->htmlNormalizer->extractedValues[$name]);
    }
}
