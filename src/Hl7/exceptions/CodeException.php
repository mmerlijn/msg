<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 00:02
 */

namespace mmerlijn\msg\src\Hl7\exceptions;

class CodeException extends \Exception
{
    public function errorMsg(){
        return 'Error on line '.$this->getLine().' in '.$this->getFile()."\n".
            $this->getMessage()."\n".
        $this->getTraceAsString();
    }
}