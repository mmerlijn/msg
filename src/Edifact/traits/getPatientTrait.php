<?php


namespace mmerlijn\msg\src\Edifact\traits;


use mmerlijn\msg\src\repo\Patient;

trait getPatientTrait
{
    public function getPatient()
    {
        $Patient = new Patient();
        $nr = $this->getSegmentnrs('PID',true);
        if($nr) {
            $Patient->dob = $this->getValue($nr, 1, 1) . "-" . $this->getValue($nr, 1, 2) . "-" . $this->getValue($nr, 1, 3);
            $Patient->sex = $this->sex(strtoupper($this->getValue($nr, 2)));
            switch (strtolower($Patient->sex)) {
                case "f":
                case "v":
                    $Patient->last_name = $this->getValue($nr, 3, 1); //mansnaam
                    $Patient->last_name_prefix = $this->getValue($nr, 3, 2);
                    $Patient->surname = $this->getValue($nr, 3, 3);
                    $Patient->surname_prefix = $this->getValue($nr, 3, 4);
                    $Patient->initials = str_replace([" ", "."], "", $this->getValue($nr, 3, 6));
                    if ($Patient->last_name) {
                        $Patient->name = trim($Patient->last_name . " " . $Patient->surname);
                    } else {
                        $Patient->name = $Patient->surname;
                    }
                    break;
                case "m":
                    $Patient->last_name = '';
                    $Patient->last_name_prefix = '';
                    $Patient->surname = $this->getValue($nr, 3, 1);
                    $Patient->surname_prefix = $this->getValue($nr, 3, 2);
                    $Patient->initials = str_replace([" ", "."], "", $this->getValue($nr, 3, 6));
                    if ($Patient->last_name) {
                        $Patient->name = trim($Patient->last_name . " " . $Patient->surname);
                    } else {
                        $Patient->name = $Patient->surname;
                    }

            }
            $bsn = trim($this->getValue($nr, 5), "BSN");
            if ($bsn) {
                $Patient->setIdentity($bsn, "NLMINBIZA", "NNNLD");
            }
        }
        $nr = $this->getSegmentNrs('PAD',true);
        if($nr) {
            $Patient->street = $this->getValue($nr, 1, 1);
            $bnr = $this->splitBuildingNr($this->getValue($nr, 1, 2));
            $Patient->building_nr = $bnr['nr'];
            $Patient->building_nr_additive = $bnr['additive'];
            $Patient->building_nr_full = trim(implode("", $bnr));
            $Patient->city = $this->getValue($nr, 1, 4);
            $Patient->postcode = $this->getValue($nr, 1, 5);
            $Patient->country = $this->getValue($nr, 1, 7);
            $Patient->phones[] = $this->getValue($nr, 2);
            $Patient->address = $Patient->street . " " . $Patient->building_nr_full;
        }
        /*
         * Verzekeringsnr????
         * */
        return $Patient;
    }
    private function sex($sex){
        switch ($sex){
            case "F":case "V"; return "F";
            case "M": return "M";
            default: return "";
        }
    }
    private function splitBuildingNr($nr){
        $nr = trim($nr);
        $buildingnr=['nr'=>"",'additive'=>""];
        for($i=0;$i<strlen($nr);$i++){
            if(!is_numeric($nr[$i])){
                $buildingnr['nr'] = substr($nr,0,$i);
                $buildingnr['additive'] = substr($nr, $i);
                return $buildingnr;
            }
        }
        $buildingnr['nr'] = $nr;
        return $buildingnr;
    }

}