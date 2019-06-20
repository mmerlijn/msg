<?php


namespace mmerlijn\msg\src\repo;


class Patient
{
    //name
    public $last_name = ''; // van partner
    public $surname = ''; //eigen achternaam
    public $last_name_prefix = '';
    public $surname_prefix = '';
    public $name = '';
    public $initials = '';
    public $type_code = 'L';//always L

    public $dob = '';

    //address
    public $address = '';
    public $street = '';
    public $city = '';
    public $postcode = '';
    public $building_nr;
    public $building_nr_additive = '';
    public $building_nr_full = '';
    public $country = 'NL';
    public $address_type = "M";

    public $phones = [];
    public $sex = '';
    //insurance
    public $insurance_plan_id = "null";
    public $insurance_set_id = 1;

    public $policy_nr = '';
    public $uzovi = '';
    public $insurance_company_name = '';
    public $insurance_company_resource = ""; //VEKTIS or LOCAL

    public $bsn = '';
    public $identities = [];

    public $identity_unknown_indicator = "Y"; //If the referrer’s verification of the BSN is unknown: “Y”. Else: “N”.
    public $identity_reliability_code = "NNNLD";

    public function setIdentity($identifier, $assigningAuthority, $typeCode)
    {
        $exist = false;
        foreach ($this->identities as $identity){
            if($assigningAuthority == $identifier['assigningAuthority']){
                $exist=true;
            }
        }
        if(!$exist){
            $this->identities[] = ['identifier' => $identifier, 'assigningAuthority' => $assigningAuthority, 'typeCode' => $typeCode];
        }
        if($assigningAuthority=="NLMINBIZA" AND $typeCode =="NNNLD")
        {
            $this->bsn = $identifier;
        }
    }
}