<?php

// $array = (new StringSplitter("Lorem ipsum dolor sit amet, consectetur adipisicing elit."))->splitString(20);

namespace mmerlijn\msg\src\Tools;


class StringSplitter
{
    public $string = "";
    public function __construct($string="")
    {
        $this->string = $string;
        return $this;
    }
    public function of(string $string)
    {
        $this->string = $string;
        return $this;
    }
    public function splitString($strlen):array
    {
        $part=[];
        $words = explode(' ', $this->string);
        $sentence="";
        foreach ($words as $word){
            if(strlen($sentence) + strlen($word)+1<$strlen){
                $sentence.=" ".$word;
            }else{
                $part[] = trim($sentence);
                $sentence=$word;
            }
        }
        $part[] = trim($sentence);
        return $part;
    }
}