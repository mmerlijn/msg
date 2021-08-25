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
        $this->setValue($H->sending_application??'50009046', $nr, 2, 1);
        //edifact aan
        $this->setValue($H->receiving_application??'50009046', $nr, 3, 1);
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
        $this->setValue("SLA", $nr, 1);
        //AGBCODE
        $this->setValue($H->sender['agbcode'], $nr, 2, 1);
        $this->setValue("CLB", $nr, 2, 2);
        $this->setValue("VEK", $nr, 2, 3);
        $this->setValue("KS ", $nr, 4, 1);
        $this->setValue($H->sender['name'], $nr, 4, 2);
        $this->setValue($Orders->requester['agbcode'], $nr, 4, 5);

        //ADR
        $nr = $this->createSegment("ADR", 'end');
        $this->setValue("1", $nr, 2, 1);
        $this->setValue($H->sender['street'], $nr, 2, 2);
        $this->setValue($H->sender['buildingnr'], $nr, 2, 3);
        $this->setValue($H->sender['city'], $nr, 3);
        $this->setValue($H->sender['postcode'], $nr, 4);
        $this->setValue($H->sender['country'], $nr, 5);


        //Telefoon
        if($H->sender['phone']) {
            $nr = $this->createSegment("COM", 'end');
            $this->setValue($H->sender['phone'], $nr, 1, 1);
            $this->setValue("TE", $nr, 1, 2);   //LET OP hier wordt ook wel "01" voor gebruikt
        }
        if ($H->sender['department']) {
            $nr = $this->createSegment('CTA', 'end');
            $this->setValue('AFD', $nr, 1);
            $this->setValue($H->sender['department'], $nr, 2, 2);
        }
        //S01 - Ontvanger
        $nr = $this->createSegment("S01", 'end');
        $this->setValue("2", $nr, 1, 1);

        //NAD
        $nr = $this->createSegment("NAD", 'end');
        $this->setValue("PO", $nr, 1); //huisarts
        //AGBCODE
        $this->setValue($Orders->requester['agbcode'], $nr, 2, 1);
        $this->setValue("CGP", $nr, 2, 2);
        $this->setValue("VEK", $nr, 2, 3);
        $n = explode(",", $Orders->requester['name']);
        $this->setValue(trim($n[0]), $nr, 4, 1);
        $this->setValue(trim($n[1] ?? ''), $nr, 4, 2);

        //$this->setValue("NP",$nr,4,5); //Naam persoon
        $this->setValue($Orders->requester['street'], $nr, 5, 1);
        $this->setValue($Orders->requester['buildingnr'], $nr, 6);
        $this->setValue($Orders->requester['city'], $nr, 7, 1);

        //S01 - Copy to
        if ($Orders->copy_to['agbcode']) {
            $nr = $this->createSegment("S01", 'end');
            $this->setValue("3", $nr, 1, 1);
            //NAD
            $nr = $this->createSegment("NAD", 'end');
            $this->setValue("PO", $nr, 1); //huisarts
            //AGBCODE
            $this->setValue($Orders->copy_to['agbcode'], $nr, 2, 1);
            $this->setValue("CGP", $nr, 2, 2);
            $this->setValue("VEK", $nr, 2, 3);
            $n = explode(",", $Orders->copy_to['name']);
            $this->setValue(trim($n[0]), $nr, 4, 1);
            $this->setValue(trim($n[1] ?? ''), $nr, 4, 2);

            //$this->setValue("NP",$nr,4,5); //Naam persoon
            $this->setValue($Orders->copy_to['street'], $nr, 5, 1);
            $this->setValue($Orders->copy_to['buildingnr'], $nr, 6);
            $this->setValue($Orders->copy_to['city'], $nr, 7, 1);
        }


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
//       if ($Orders->resultDateTime) {
//           $nr = $this->createSegment("DTM", 'end');
//           $this->setValue("ISR", $nr, 1, 1);
//           $this->setValue(date_create_from_format("Y-m-d H:i:s", $Orders->resultDateTime)->format("YmdHi"), $nr, 1, 2);
//           $this->setValue("203", $nr, 1, 3);
//       }

        //S04   VOLGENS MIJ ZOU S04 HELEMAAL WEGGELATEN KUNNEN WORDEN (alleen vullen indien gegevens aanwezig
        // if ($Orders->requester['agbcode'] and ($Orders->request_date or $Orders->created_at)) {

        $nr = $this->createSegment("S04", 'end');
        $this->setValue("1", $nr, 1, 1);
        $this->setValue("N", $nr, 2, 1);

        //RFF
        $nr = $this->createSegment("RFF", 'end');
        $this->setValue("ROI", $nr, 1, 1);
        $this->setValue($Orders->labnr, $nr, 1, 2);
        $start_time = date_create_from_format("Y-m-d H:i:s", $Orders->orders[0]->observation_start_time ?? ($Orders->request_date ? $Orders->request_date : $Orders->created_at))->format("YmdHi");
        $end_time = date_create_from_format("Y-m-d H:i:s", $Orders->orders[0]->observation_end_time ?? ($Orders->request_date ? $Orders->request_date : $Orders->created_at))->format("YmdHi");
        //DTM
        $nr = $this->createSegment('DTM', 'end');
        $this->setValue($start_time, $nr, 1, 2);
        //DTM
        $nr = $this->createSegment('DTM', 'end');
        $this->setValue($end_time, $nr, 1, 2);
        //}
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
        //PDI (geslacht)
        if (strtoupper($P->sex) == "F") {
            $sex = "2";
        } elseif (strtoupper($P->sex) == "M") {
            $sex = "1";
        } else {
            $sex = "9";
        }
        $nr = $this->createSegment("PDI", 'end');
        $this->setValue($sex, $nr, 1);

        //S16
        $nr = $this->createSegment("S16", 'end');
        $this->setValue(1, $nr, 1, 1);
        //SPC
        $nr = $this->createSegment("SPC", 'end');
        $this->setValue("TSP", $nr, 1);
        if (isset($Orders->orders[0]->observation_end_time)) {
            //DTM
            $nr = $this->createSegment("DTM", 'end');
            $this->setValue("SCO", $nr, 1, 1);
            $this->setValue(date_create_from_format("Y-m-d H:i:s", $Orders->orders[0]->observation_end_time)->format("YmdHi"), $nr, 1, 2);
            $this->setValue("203", $nr, 1, 3);
        }

        $teller = 1;
        foreach ($Orders->orders as $order) {
            $c_teller = 1;
            foreach ($order->order_comments as $comment) {
                //S18
                $nr = $this->createSegment("S18", 'end');
                $this->setValue($c_teller, $nr, 1, 1);
                $this->setValue("G", $nr, 1, 2);
                //INV
                $nr = $this->createSegment("INV", 'end');
                $this->setValue(1, $nr, 1);
                $this->setValue($comment->identifier_code, $nr, 2, 1);
                $this->setValue("AMB", $nr, 2, 2);
                $this->setValue("NHG", $nr, 2, 3);
                //$this->setValue($comment->identifier_code, $nr, 2, 4);
                //RSL
                if (is_numeric($comment->value)) {
                    $type = "NV";
                } else {
                    $type = "TV";
                }
                $nr = $this->createSegment("RSL", 'end');
                $this->setValue($type, $nr, 1); //NV numerieke waarde // NR numerieke waarde interval  //AV korte alfanumerieke waarde
                $this->setValue($comment->value, $nr, 2, 1);
                $this->setValue($comment->units, $nr, 4, 1);
                //geen normale uitslag? dam
                $this->setValue(($comment->abnormal_flags == "N") ? "1" : "0", $nr, 5);

                $ref_range = explode("-", $comment->references_range);
                if (count($ref_range) == 2) {
                    //S20   ONDERGRENS BOVENGRENS
                    $nr = $this->createSegment("S20", 'end');
                    $this->setValue(1, $nr, 1, 1);
                    $nr = $this->createSegment("RND", 'end');
                    $this->setValue("RU", $nr, 1);
                    $this->setValue($ref_range[0], $nr, 2);
                    $this->setValue($ref_range[1], $nr, 3);
                }

                foreach ($comment->notes as $note) {
                    $nr = $this->createSegment("FTX", 'end');
                    $this->setValue("UIT", $nr, 1);
                    $notes = str_split($note->comment, 70);
                    foreach ($notes as $t => $val) {
                        $this->setValue($val, $nr, 4, $t + 1);
                    }
                }

                $c_teller++;
            }
            $teller++;
        }
        $nr = $this->createSegment("UNT", 'end');
        $this->setValue(count($this->tree) - 1, $nr, 1);
        $this->setValue($H->message_control_id, $nr, 2);

        $nr = $this->createSegment("UNZ", 'end');
        $this->setValue("1", $nr, 1);
        $this->setValue($H->message_control_id, $nr, 2);
    }
}