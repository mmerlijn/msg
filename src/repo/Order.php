<?php


namespace mmerlijn\msg\src\repo;


class Order
{
    public $id = '';
    public $placer_order_nr = ''; //zdnr
    public $filler_order_nr = '';  //labnr
    public $diagnostic_test_code = ''; //testcode
    public $diagnostic_test_name = '';
    public $diagnostic_test_source = '';//99zda=Zorgdomein defined, 99zdl=user defined, else see Table0396

    public $alternate_diagnostic_test_code='';
    public $alternate_diagnostic_test_name='';
    public $alternate_diagnostic_test_source='';

    public $observation_start_time = '';
    public $observation_end_time = '';
    public $action_code = ""; //at home => L, else O
    public $clinical_information = '';
    //16 = ordering provider this is the same as ordering provider from ORC => see requester
    //17 same as phonenumbers from ORC
    public $result_status = '';
    public $request_date = '';

    public $collection_volume_units='';
    public $collection_volume_quantity='';
    public $specimen_received_datetime = null;
    public $specimen_source = "";
    public $order_comments = [];

    public $notes = [];

    public $position; //position where the order will be placed in de the msg (0=first,1 =second, -1 =last, -2=second last

    public function addOrderComment(OrderComment $comment)
    {
        $present = false;
        foreach ($this->order_comments as $k => $o) {
            if ($o->identifier_code == $comment->identifier_code) {
                $present = true;
                $updateableOrderNr = $k;
            }
        }
        if (!$present) {
            $this->order_comments[] = $comment;
            $nr = count($this->order_comments) - 1;
            if (!$this->order_comments[$nr]->id) {
                $this->order_comments[$nr]->id = $nr + 1;
            }
        } else {
            $this->order_comments[$updateableOrderNr]->value = $comment->value;
            $this->order_comments[$updateableOrderNr]->type_of_value = $comment->type_of_value;
            $this->order_comments[$updateableOrderNr]->identifier_label = $comment->identifier_label;
            $this->order_comments[$updateableOrderNr]->identifier_source = $comment->identifier_source;
            $this->order_comments[$updateableOrderNr]->value_code = $comment->value_code;
            $this->order_comments[$updateableOrderNr]->value_source = $comment->value_source;

        }
    }

    public function addOrderNote(OrderNote $note)
    {
        $this->notes[] = $note;
    }

    public function deleteOrderCommentByIdentifierCode(string $identifier_code):void
    {
        foreach ($this->order_comments as $k => $o) {
            if ($o->identifier_code == $identifier_code or $o->identifier_label == $identifier_code) {
                array_splice($this->order_comments, $k, 1);
            }
        }
        //sort($this->order_comments);
    }
}