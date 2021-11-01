<?php


namespace mmerlijn\msg\src\repo;


class Orders
{
    public $update_time_request = '';
    public $fax = '';
    public $phone = '';
    public $control = 'NW'; //NW=new order, CA=cancel request, RO=replacement order, XO=change order request
    public $order_control_reason='';
    public $requestnr = ''; //zdnr / parnassia nr (placer ordernr / placer groupnr)
    public $labnr = '';
    public $complete = "Y"; //Wordt nog niets mee gedaan wel uitgelezen uit edifact
    public $request_date = '';
    public $priority = ""; //S=faxed, R=regular (else)
    public $created_at = '';
    public $pointOfCare = '';
    public $entered_by = [ //ORC 10
        'agbcode' => '',
        'name' => '',
        'source' => ''
    ];
    public $verified_by = [ //ORC 11
        'agbcode' => '',
        'name' => '',
        'source' => ''
    ];
    public $requester = [ //ordering provider orc12
        'agbcode' => '',
        'name' => '',
        'source' => '',
        'street' => '',
        'buildingnr' => '',
        'city' => ''
    ];
    public $entering_organisation = [ //orc17
        'agbcode' => '',
        'name' => '',
        'source' => ''
    ];
    public $entering_location = [ //orc13
        'agbcode' => '',
        'name' => '',
        'location' => ''
    ];
    public $action_by = [ //orc19
        'agbcode' => '',
        'name' => '',
        'source' => ''
    ];
    public $ordering_facility = [ //orc21
        'agbcode' => '',
        'name' => '',
        'source' => ''
    ];
    public $copy_to = [
        'agbcode' => '',
        'name' => '',
        'source' => '',
        'street' => '',
        'buildingnr' => '',
        'city' => ''
    ];
    public $order_effective_datetime = ""; //Alleen bij CA, RO en XO (zie $control)
    //PV1
    public $pv1 = false; //pv1 present and shown
    public $patient_visit_set_id = 1;
    public $patient_visit_class = "O";
    public $patient_visit_indicator = "V";
    public $patient_visit_assigned_location = []; //PV1.3
    public $patient_visit_visit_number = []; //PV1.19

    //PV2
    public $admit_reason_code;
    public $admit_reason_name;
    public $admit_reason_source = "99zda";

    public $collector_identifier = [
        'id' => '',
        'last_name' => '',
        'first_name' => ''
    ];

    public $responsible_observer_name = "";
    public $organisation_name = "";
    public $organisation_address = ['street' => '', 'buildingnr' => '', 'city' => '', 'postcode' => ''];
    public $organisation_phone = "";

    public $collectors_comment = '';

    public $order_status = '';

    public $diagnostic_serv = ""; //OBR 24 bv. LAB (L)
    public $action_code = ""; //at home => L, else O
    public $result_status = ''; //F=final, C=correction
    public $resultDateTime = ''; //OBR22
    public $timing_quantity = ['priority' => ''];
    public $orders = [];
    public $notes = [];

    public function __construct()
    {
        $this->created_at = date("Y-m-d H:i:s");
    }

    public function addOrder(Order $Order): void
    {
        $present = false;
        $id = 0;
        foreach ($this->orders as $k => $o) {
            if ($o->diagnostic_test_code == $Order->diagnostic_test_code) {
                $present = true;
                $id = $k;
            }
        }
        if (!$present) {
            $id = count($this->orders);
            $this->orders[$id] = $Order;

        }
        //adding the order comments to the order (if they exist)
        if (!empty($Order->order_comments)) {
            foreach ($Order->order_comments as $oc) {
                $this->orders[$id]->addOrderComment($oc);
            }
        }
        // update the position
        if ($Order->position !== null) {
            $this->orders[$id]->position = $Order->position;
        }
    }

    public function addComment(OrderComment $Comment, $position = 'last'): void
    {
        if (!in_array($position, ['last', 'first', 'all'])) {
            throw new \Exception("Add comment only accepts for position first, last, all");
        } else {
            if (count($this->orders)) {
                switch ($position) {
                    case "first":
                        $this->orders[0]->addOrderComment($Comment);
                        break;
                    case "last":
                        ($this->orders[count($this->orders) - 1])->addOrderComment($Comment);
                        break;
                    case 'all':
                        foreach ($this->orders as $order) {
                            $order->addOrderComment($Comment);
                        }
                }
            }
        }
    }
    public function setOrderPositionByOrder(Order $order,$to){
        switch($to){
            case "last": $to=count($this->orders);break;
            case "first": $to=0;break;
        }
        foreach ($this->orders as $k=>$o){
            if($order->diagnostic_test_code == $o->diagnostic_test_code){
                unset($this->orders[$k]);
                array_splice($this->orders, $to,0,[$o]);
            }
        }
    }
    public function setOrderPositionByTestcode(string $testcode,$to){
        switch($to){
            case "last": $to=count($this->orders);break;
            case "first": $to=0;break;
        }
        foreach ($this->orders as $k=>$o){
            if($testcode == $o->diagnostic_test_code){
                unset($this->orders[$k]);
                array_splice($this->orders, $to,0,[$o]);
            }
        }
    }
    public function deleteOrderCommentByIdentifierCode(string $identifier_code): void
    {
        foreach ($this->orders as $order) {
            $order->deleteOrderCommentByIdentifierCode($identifier_code);
        }
    }

    public function deleteOrderByTestCode($testcode)
    {
        foreach ($this->orders as $i => $order) {
            if ($order->diagnostic_test_code == $testcode) {
                array_splice($this->orders, $i, 1);
            }
        }
    }

    public function unsetRequester()
    {
        $this->entered_by = [
            'agbcode' => '',
            'name' => '',
            'source' => ''
        ];
        $this->requester = [ //ordering provider orc12
            'agbcode' => '',
            'name' => '',
            'source' => ''
        ];
        $this->entering_organisation = [ //orc17
            'agbcode' => '',
            'name' => '',
            'source' => ''
        ];
        $this->entering_location = [ //orc13
            'agbcode' => '',
            'name' => '',
            'location' => ''
        ];
        $this->action_by = [ //orc19
            'agbcode' => '',
            'name' => '',
            'source' => ''
        ];
        $this->ordering_facility = [ //orc21
            'agbcode' => '',
            'name' => '',
            'source' => ''
        ];
        $this->copy_to = [
            'agbcode' => '',
            'name' => '',
            'source' => ''
        ];
    }
}