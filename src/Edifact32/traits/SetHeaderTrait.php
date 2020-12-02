<?php


namespace mmerlijn\msg\src\Edifact32\traits;


use mmerlijn\msg\src\repo\Header;
use mmerlijn\msg\src\repo\Orders;
use mmerlijn\msg\src\repo\Patient;

trait SetHeaderTrait
{
    public function setHeader(Header $H, Orders $Orders, Patient $P): void
    {
        //UNOA
        $nr = $this->createSegment("UNB", 'end');
        $this->setValue('UNOA', $nr, 1, 1);
        $this->setValue('1', $nr, 1, 2);
        //edifact van
        $this->setValue("50009046", $nr, 2, 1);
        //edifact aan
        $this->setValue("50009046", $nr, 3, 1);
        $this->setValue(date("ymd"), $nr, 4, 1);
        $this->setValue(date("Hi"), $nr, 4, 2);
        //identificatienr
        $this->setValue($H->message_control_id, $nr, 5);

        //UNH
        $nr = $this->createSegment("UNH", 'end');
        //identificatienr
        $this->setValue($H->message_control_id, $nr, 1);
        $this->setValue('MEDRPT', $nr, 2, 1);
        $this->setValue('D', $nr, 2, 2);
        $this->setValue('93A', $nr, 2, 3);
        $this->setValue('UN', $nr, 2, 4);
        $this->setValue('MRPN32', $nr, 2, 5);

        //BGM
        $nr = $this->createSegment("BGM", 'end');
        $this->setValue("LRP", $nr, 1, 1);
        $this->setValue("MF", $nr, 1, 2);
        $this->setValue("ITN", $nr, 1, 3);
        $this->setValue($Orders->labnr, $nr, 2);
        $this->setValue("9", $nr, 3);
        $this->setValue("NA", $nr, 4);// AB Message acknowledgement, ERR Only needed if received in error, NA No acknowledgement needed

        //DTM
        $nr = $this->createSegment("DTM", 'end');
        $this->setValue("137", $nr, 1, 1);
        $this->setValue(date("YmdHi"), $nr, 1, 2);
        $this->setValue("203", $nr, 1, 3);

        //S01   Verzender
        $nr = $this->createSegment("S01", 'end');
        $this->setValue("1", $nr, 1, 1);

        //NAD
        $nr = $this->createSegment("NAD", 'end');
        $this->setValue("MS", $nr, 1); //huisarts
        //AGBCODE
        $this->setValue($Orders->requester['agbcode'], $nr, 2, 1);
        $this->setValue("AGB", $nr, 2, 2);
        $this->setValue("VEK", $nr, 2, 3);
        $this->setValue($Orders->requester['name'], $nr, 4, 1);

        //ADR
        //Adres gegevens verzender (hier hebben we waarschijnlijk geen data van)
        //$nr = $this->getSegmentNrs('ADR',true,true);

        //COM TELEFOON
        if ($Orders->phone) {
            $nr = $this->createSegment("COM", 'end');
            $this->setValue($Orders->phone, $nr, 1, 1);
            $this->setValue("TE", $nr, 1, 2);   //LET OP hier wordt ook wel "01" voor gebruikt
        }
        //COM FAX
        if ($Orders->fax) {
            $nr = $this->createSegment("COM", 'end');
            $this->setValue($Orders->fax, $nr, 1, 1);
            $this->setValue("FX", $nr, 1, 2);   //LET OP hier wordt ook wel "03" voor gebruikt
        }
        //CTA
        if ($Orders->requester['name']) {
            $nr = $this->createSegment("CTA", 'end');
            $this->setValue("PRS", $nr, 1);
            $this->setValue($Orders->requester['name'], $nr, 2, 2);
        }
        //S01 - Ontvanger
        $nr = $this->createSegment("S01", 'end');
        $this->setValue("2", $nr, 1, 1);
        //NAD
        $nr = $this->createSegment("NAD", 'end');
        $this->setValue("SLA", $nr, 1);
        //AGBCODE
        $this->setValue("530008", $nr, 2, 1);
        $this->setValue("AGB", $nr, 2, 2);
        $this->setValue("VEK", $nr, 2, 3);
        $this->setValue("SALT", $nr, 4, 1);
        //$this->setValue("01100602", $nr, 4, 5);

        //ADR
        $nr = $this->createSegment("ADR", 'end');
        $this->setValue("1", $nr, 2, 1);
        $this->setValue("Molenwerf", $nr, 2, 2);
        $this->setValue("11", $nr, 2, 3);
        $this->setValue("Koog ad Zaan", $nr, 3);
        $this->setValue("1541WR", $nr, 4);
        $this->setValue("NL", $nr, 5);

        //CTA
        $nr = $this->createSegment("CTA", 'end');
        $this->setValue("AFD", $nr, 1);
        $this->setValue("SALT", $nr, 2, 2);


        //S02
        $nr = $this->createSegment("S02", 'end');
        $this->setValue("1", $nr, 1, 1);
        $this->setValue("N", $nr, 2, 1);

        //RFF
        if ($Orders->labnr) {
            $nr = $this->createSegment("RFF", 'end');
            $this->setValue("SRI", $nr, 1, 1);
            $this->setValue($Orders->labnr, $nr, 1, 2);
        }
        //STS
        $nr = $this->createSegment("STS", 'end');
        $this->setValue("G", $nr, 2);

        //DTM
        if ($Orders->resultDateTime) {
            $nr = $this->createSegment("DTM", 'end');
            $this->setValue("ISR", $nr, 1, 1);
            $this->setValue(date_create_from_format("Y-m-d H:i:s", $Orders->resultDateTime)->format("YmdHi"), $nr, 1, 2);
            $this->setValue("203", $nr, 1, 3);
        }
        //S04   VOLGENS MIJ ZOU S04 HELEMAAL WEGGELATEN KUNNEN WORDEN
        $nr = $this->createSegment("S02", 'end');
        $this->setValue("1", $nr, 1, 1);
        $this->setValue("N", $nr, 2, 1);

        //RFF
        if ($Orders->requester) {
            $nr = $this->createSegment("RFF", 'end');
            $this->setValue("ROI", $nr, 1, 1);
            $this->setValue($Orders->requester['agbcode'], $nr, 1, 2);
        }

        //S06
        $nr = $this->createSegment("S06", 'end');
        $this->setValue("1", $nr, 1, 1);
        //ADR
        $nr = $this->createSegment("ADR", 'end');
        $this->setValue("1", $nr, 2, 1);
        $this->setValue($P->street, $nr, 2, 2);
        $this->setValue($P->building_nr_full, $nr, 2, 3);
        $this->setValue($P->city, $nr, 3);
        $this->setValue($P->postcode, $nr, 4);
        $this->setValue("NL", $nr, 5);
        //COM TELEFOON
        if (isset($P->phones[0])) {
            $nr = $this->createSegment("COM", 'end');
            $this->setValue($P->phones[0], $nr, 1, 1);
            $this->setValue("TE", $nr, 1, 2);   //LET OP hier wordt ook wel "01" voor gebruikt
        }
        //S07
        $nr = $this->createSegment("S07", 'end');
        $this->setValue("1", $nr, 1, 1);
        //PNA
        $nr = $this->createSegment("PNA", 'end');
        $this->setValue("PAT", $nr, 1);
        $this->setValue($P->bsn, $nr, 2, 3);
        $this->setValue("NAN", $nr, 5, 1);
        $this->setValue($P->surname, $nr, 5, 2);
        //voorletters
        $this->setValue("NVV", $nr, 6, 1);
        $this->setValue($P->initials . ($P->surname_prefix ? "*" . $P->surname_prefix : ""), $nr, 6, 2);
        //achternaam
        if ($P->last_name) {
            $this->setValue("NEA", $nr, 8, 1);
            $this->setValue($P->last_name, $nr, 8, 2);
            if ($P->last_name_prefix) {
                $this->setValue("NEV", $nr, 9, 1);
                $this->setValue($P->last_name_prefix, $nr, 9, 2);
            }
        }
        //DTM
        if ($P->dob) {
            $nr = $this->createSegment("DTM", 'end');
            $this->setValue("329", $nr, 1, 1);
            $this->setValue(date_create_from_format("Y-m-d", $P->dob)->format("Ymd"), $nr, 1, 2);
            $this->setValue("102", $nr, 1, 3);
        }
        $teller = 1;
        foreach ($Orders->orders as $order) {
            //S16
            $nr = $this->createSegment("S16", 'end');
            $this->setValue($teller, $nr, 1, 1);

            //SPC
            $nr = $this->createSegment("SPC", 'end');
            $this->setValue("TCP", $nr, 1);
            $this->setValue($order->diagnostic_test_code, $nr, 2, 1); //identification
            foreach ($order->notes as $note){
                $nr = $this->createSegment("FTX", 'end');
                $this->setValue("UIT", $nr, 1);
                $notes = str_split($note->comment,70);
                foreach ($notes as $t=>$val) {
                    $this->setValue($val, $nr, 4, $t + 1);
                }
            }
            //DTM
            $nr = $this->createSegment("DTM", 'end');
            $this->setValue("SCO", $nr, 1, 1);
            $this->setValue(date_create_from_format("Y-m-d H:i:s", $order->observation_end_time)->format("YmdHi"), $nr, 1, 2);
            $this->setValue("203", $nr, 1, 3);

            $c_teller=1;
            foreach ($order->order_comments as $comment) {
                //S18
                $nr = $this->createSegment("S18", 'end');
                $this->setValue($c_teller, $nr, 1, 1);
                //INV
                $nr = $this->createSegment("INV", 'end');
                $this->setValue("MS", $nr, 1);
                $this->setValue($comment->identifier_code, $nr, 2,1);
                $this->setValue("AMB", $nr, 2,2);
                $this->setValue("NHG", $nr, 2,3);
                //RSL
                if(is_numeric($comment->value)){
                    $type = "NV";
                }else{
                    $type = "AV";
                }
                $nr = $this->createSegment("RSL", 'end');
                $this->setValue($type, $nr, 1); //NV numerieke waarde // NR numerieke waarde interval  //AV korte alfanumerieke waarde
                $this->setValue($comment->value, $nr, 2,1);
                //$this->setValue(, $nr, 3,1);
                $this->setValue($comment->units, $nr, 4,4);
                //geen normale uitslag? dam
                $this->setValue(($comment->abnormal_flags=="N")?"1":"0", $nr, 5);
                foreach ($comment->notes as $note){
                    $nr = $this->createSegment("FTX", 'end');
                    $this->setValue("UIT", $nr, 1);
                    $notes = str_split($note->comment,70);
                    foreach ($notes as $t=>$val) {
                        $this->setValue($val, $nr, 4, $t + 1);
                    }
                }
                $ref_range = explode("-", $comment->references_range);
                if(count($ref_range)==2) {
                    //S20   ONDERGRENS BOVENGRENS
                    $nr = $this->createSegment("S20", 'end');
                    $this->setValue(1, $nr, 1, 1);
                    $nr = $this->createSegment("RND", 'end');
                    $this->setValue("RU", $nr, 1);
                    $this->setValue($ref_range[0], $nr, 2);
                    $this->setValue($ref_range[1], $nr, 3);
                }
                $c_teller++;
            }
            $teller++;
        }
        $nr = $this->createSegment("UNT", 'end');
        $this->setValue(count($this->tree)-1, $nr, 1);
        $this->setValue($H->message_control_id, $nr, 2);

        $nr = $this->createSegment("UNZ", 'end');
        $this->setValue("1", $nr, 1);
        $this->setValue($H->message_control_id, $nr, 2);
    }
}