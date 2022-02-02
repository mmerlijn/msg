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
    public $address_type = "H"; //home address
    public $address_valid_start = "";
    public $address_valid_end = "";

    //second address
    public $second_address = false; //default only one address
    public $address2 = '';
    public $street2 = '';
    public $city2 = '';
    public $postcode2 = '';
    public $building_nr2 = '';
    public $building_nr_additive2 = '';
    public $building_nr_full2 = '';
    public $country2 = 'NL';
    public $address_type2 = "C";
    public $address_valid_start2 = "";
    public $address_valid_end2 = "";

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
    public $identities_alternate = [];

    public $identity_unknown_indicator = "Y"; //If the referrer’s verification of the BSN is unknown: “Y”. Else: “N”.
    public $identity_reliability_code = "NNNLD";

    public function setIdentity($identifier, $assigningAuthority, $typeCode, $alternate = false)
    {
        if (!$alternate) {
            $exist = false;
            foreach ($this->identities as $identity) {
                if ($assigningAuthority == $identity['assigningAuthority']) {
                    $exist = true;
                }
            }
            if (!$exist) {
                $this->identities[] = ['identifier' => $identifier, 'assigningAuthority' => $assigningAuthority, 'typeCode' => $typeCode];
            }
            if ($assigningAuthority == "NLMINBIZA" and $typeCode == "NNNLD") {
                $this->bsn = $identifier;
            }
        } else {
            $exist = false;
            foreach ($this->identities_alternate as $identity) {
                if ($assigningAuthority == $identity['assigningAuthority']) {
                    $exist = true;
                }
            }
            if (!$exist) {
                $this->identities_alternate[] = ['identifier' => $identifier, 'assigningAuthority' => $assigningAuthority, 'typeCode' => $typeCode];
            }
            if ($assigningAuthority == "NLMINBIZA" and $typeCode == "NNNLD") {
                $this->bsn = $identifier;
                $this->setIdentity($identifier, $assigningAuthority, $typeCode, false);
            }
        }

    }

    public function toArray()
    {
        $response = [
            "sex" => $this->sex,
            "last_name" => $this->last_name,
            "surname" => $this->surname,
            "last_name_prefix" => $this->last_name_prefix,
            "surname_prefix" => $this->surname_prefix,
            "name" => $this->name,
            "initials" => $this->initials,
            "type_code" => $this->type_code,
            "dob" => $this->dob,
            "bsn" => $this->bsn,
            "identities" => $this->identities,
            "identities_alternate" => $this->identities_alternate,
            "adres" => [
                "address" => $this->address,
                "street" => $this->street,
                "city" => $this->city,
                "postcode" => $this->postcode,
                "building_nr" => $this->building_nr,
                "building_nr_additive" => $this->building_nr_additive,
                "building_nr_full" => $this->building_nr_full,
                "country" => $this->country,
                "address_type" => $this->address_type,
                "address_valid_start" => $this->address_valid_start,
                "address_valid_end" => $this->address_valid_end,
            ],
            "phones" => $this->phones,
            "insurance" => [
                "policy_nr" => $this->policy_nr,
                "uzovi" => $this->uzovi,
                "insurance_company_name" => $this->insurance_company_name,
                "insurance_company_resource" => $this->insurance_company_resource,
            ]

        ];
        if ($this->second_address) {
            $response['adres2'] =
                [
                    "address" => $this->address2,
                    "street" => $this->street2,
                    "city" => $this->city2,
                    "postcode" => $this->postcode2,
                    "building_nr" => $this->building_nr2,
                    "building_nr_additive" => $this->building_nr_additive2,
                    "building_nr_full" => $this->building_nr_full2,
                    "country" => $this->country2,
                    "address_type" => $this->address_type2,
                    "address_valid_start" => $this->address_valid_start2,
                    "address_valid_end" => $this->address_valid_end2,
                ];
        }
        return $response;
    }
}