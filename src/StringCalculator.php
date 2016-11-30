<?php

namespace Kata\StringCalculator;

class DoubleSeparatorException extends \Exception
{
}

class NegativeNumbersException extends \Exception
{

}

class StringCalculator
{
    public function Add($numberString)
    {


        $sep = ',';
        if (strlen($numberString) > 4 && $numberString[0] == '/' && $numberString[1] == '/' &&
            $numberString[3] == "\n")
        {
            $sep = $numberString[2];
            $numberString = substr($numberString, 4);
        }

        $numberString = str_replace("\n", $sep, $numberString);
        if (strpos($numberString, $sep."".$sep)) { throw new DoubleSeparatorException();}
        $array = explode($sep, $numberString);


        $sum = 0;
        $exceptionMessage="";
        for ($i = 0; $i < count($array); $i++)
        {
            $sum += $array[$i];
            if ($array[$i] < 0)
            {
                $exceptionMessage = $exceptionMessage.$array[$i];
            }
        }
        if ($exceptionMessage != "")
        {
            throw new NegativeNumbersException("$exceptionMessage");
        }



        return $sum;
    }
}