<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 29-1-2019
 * Time: 22:41
 */

namespace mmerlijn\msg\src\Hl7\Exceptions;


class ValidationException extends \Exception
{
    public function errorMsg(){
        $errorMsg = $this->getMessage();
        return $errorMsg;
    }

}