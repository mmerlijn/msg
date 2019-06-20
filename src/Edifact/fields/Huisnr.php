<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Huisnr extends Field
{
    protected static $name = 'Huisnr';
    protected static $type = "an";
    protected static $length = 8;
    protected static $varLength=true;
}