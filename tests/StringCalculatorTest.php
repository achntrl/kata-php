<?php


namespace Kata\StringCalculator {

    use PHPUnit\Framework\TestCase;

    class StringCalculatorTest extends TestCase
    {
        public function xtestEmptyString()
        {
            $a = new StringCalculator();

            $this->assertEquals(0, $a->Add(""));
        }

        public function xtestOneNumber()
        {
            $a = new StringCalculator();

            $this->assertEquals(0, $a->Add("0"));
            $this->assertEquals(1, $a->Add("1"));
            $this->assertEquals(10, $a->Add("10"));
        }

        public function xtestTwoNumbers()
        {
            $a = new StringCalculator();

            $this->assertEquals(2, $a->Add("1,1"));
            $this->assertEquals(22, $a->add("1,21"));
            $this->assertEquals(1, $a->add(",1"));
            $this->assertEquals(1, $a->add("1,"));
            $this->assertEquals(0, $a->add(","));
        }

        public function xtestArbitraryAmountOfNumbers()
        {
            $a = new StringCalculator();

            $this->assertEquals(3, $a->Add("1,1,1"));
            $this->assertEquals(6, $a->Add("1,1,1,1,1,1"));
        }

        public function testNewLinesSupport()
        {
            $a = new StringCalculator();

            $this->assertEquals(6, $a->Add("1\n2,3"));
        }

        public function testExceptions()
        {
            $a = new StringCalculator();

            $this->expectException(DoubleSeparatorException::class);
            $a->Add("1,\n");
        }

        public function testDelimiters()
        {
            $a = new StringCalculator();

            $this->assertEquals(3, $a->Add("//;\n1;2"));
            $this->assertEquals(6, $a->Add("//;\n1;2\n3"));
        }

        public function testNegativeNumber()
        {
            $a = new StringCalculator();

            $this->expectException(NegativeNumbersException::class);
            $this->expectExceptionMessage("-1");
            $a->Add("1,-1");
        }

        public function testNegativeNumbers()
        {
            $a = new StringCalculator();

            $this->expectException(NegativeNumbersException::class);
            $this->expectExceptionMessage("-1-2-3");
            $a->Add("1,-1,3,-2,-3");
        }
    }
}