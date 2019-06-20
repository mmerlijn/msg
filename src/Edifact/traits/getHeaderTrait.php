<?php


namespace mmerlijn\msg\src\Edifact\traits;


use mmerlijn\msg\src\repo\Header;

trait getHeaderTrait
{
    public function getHeader()
    {
        $h = new Header();
        $h->country_code="NLD";
        return $h;
    }
}