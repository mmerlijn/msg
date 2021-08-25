<?php

namespace mmerlijn\msg\tests;

use mmerlijn\msg\src\Edifact\Edifact;
use mmerlijn\msg\src\Edifact\MEDVRI;
use mmerlijn\msg\src\repo\Order;
use mmerlijn\msg\src\repo\OrderNote;
use mmerlijn\msg\src\repo\Orders;
use PHPUnit\Framework\TestCase;

class EdifactOrdersTest extends TestCase
{
    private $edi;

    protected function setUp(): void
    {
        $this->edi = new Edifact();
    }
    public function test_get_medvri_orders()
    {
        $edifact= "UNB+UNOA:1+50001111+50002222+201201:1401+1020'
UNH+1020+MEDVRI:1'
GGA+Organisation name+Fill work+Organisation name+New Street:12::Amsterdam:1000AA+?+31612341234'
DET+21:06:08+15:32'
PID+1980:10:25+V+Berg:van de:Jansen:van::P.++BSN123456782'
PAD+Blue street:43b::Amsterdam:1040BB+?+31612345678'
TXT:1+Hello World'
TXT:2+This is a message'
TXT:3+'
TXT:3+Greetings'
GGO+Arts Lastname+++Old street:3b::Amsterdam:'
UNT+11+1020'
UNZ+1+1020'
";
        $this->edi->read($edifact);
        $orders = $this->edi->getOrders();
        //var_dump($orders);
        $this->assertSame('Hello World
This is a message

Greetings',$orders->orders[0]->notes[0]->comment);
    }

    public function test_set_medvri_orders()
    {
        $this->edi = new MEDVRI();
        $orders = new Orders();
        $order = new Order();
        $order->observation_start_time = "2021-06-07 12:12:00";
        $orderNote = new OrderNote();
        $orderNote->comment = "Hello World
this is a message

greetings";
        $order->addOrderNote($orderNote);
        $orders->addOrder($order);

        $this->edi->setOrders($orders);
        //$this->edi->dumpTree();
        $this->assertSame("DET+21:06:07+12:12'". chr(13).
            "TXT:1+Hello World'".chr(13).
"TXT:2+this is a message'".chr(13).
"TXT:3'".chr(13).
"TXT:4+greetings'".chr(13), $this->edi->write());
    }
}
