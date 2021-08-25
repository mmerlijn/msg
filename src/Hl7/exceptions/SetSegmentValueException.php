<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 15:55
 */

namespace mmerlijn\msg\src\Hl7\exceptions;


class SetSegmentValueException extends \Exception
{
    public function errorMsg(){
        $errorMsg = $this->getMessage();
        return $errorMsg;
    }
}