<?php


namespace mmerlijn\msg\src\Msg;


class ContentTester
{

    //supported types
    //HL7
    //edifact
    //edifact32 LATER
    //json
    //xml
    
    public static function getContent(string $msg)
    {
        if(mb_substr($msg, 0,4)==="MSH|"){
            return 'HL7';
        }elseif(mb_substr($msg, 0,4)=="UNB+"){
            return "Edifact";
        }elseif(mb_substr($msg, 0,4)=="UNA+"){
            return "Edifact";
        }elseif(mb_substr($msg,0,1)=="("){
            return "json";
        }elseif(mb_substr($msg,0,1)=="<"){
            return "xml";
        }else{
            throw new \Exception('Message type of '.mb_substr($msg, 0,20)." could not be found");
        }
    }
}