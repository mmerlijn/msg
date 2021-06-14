<?php


namespace mmerlijn\msg\src\Edifact\traits;


use mmerlijn\msg\src\repo\Orders;
use mmerlijn\msg\src\Tools\StringSplitter;

trait setOrdersTrait
{
    public function setOrders(Orders $o)
    {
        $nr = $this->getSegmentNrs('DET',true,true);
        if($o->resultDateTime){
            $now = date_create($o->resultDateTime)       ;
        }elseif($o->orders[0]->observation_start_time){
            $now = date_create($o->orders[0]->observation_start_time);
        }else{
            $now = date_create();
        }
        $this->setValue($now->format('y'), $nr, 1,1);
        $this->setValue($now->format('m'), $nr, 1,2);
        $this->setValue($now->format('d'), $nr, 1,3);
        $this->setValue($now->format('H'), $nr, 2,1);
        $this->setValue($now->format('i'), $nr, 2,2);

        if($this->messageType=="MEDVRI"){
            foreach (explode(PHP_EOL, $o->orders[0]->notes[0]->comment) as $line){
                if(strlen($line)>70){
                    $parts = (new StringSplitter())->of($line)->splitString(70);
                    foreach ($parts as $part){
                        $nr = $this->createSegment('TXT');
                        $this->setValue($part, $nr, 1,1);
                    }
                }else{
                    $nr = $this->createSegment('TXT');
                    $this->setValue($line, $nr, 1,1);
                }
            }

        }
    }

}