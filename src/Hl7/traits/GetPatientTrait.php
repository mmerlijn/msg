<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 20:32
 */

namespace mmerlijn\msg\src\Hl7\traits;

use mmerlijn\msg\src\repo\Patient;

trait GetPatientTrait
{
    public function getPatient()
    {
        $Patient = new Patient();
        $nr = $this->getSegmentNrs('PID', true);
        if ($nr !== false) {
            $Patient->sex = $this->getPatientSex();
            $Patient->dob = $this->getPatientDob();
            $name = $this->getPatientName();
            $Patient->last_name = $name['last_name'];
            $Patient->surname = $name['surname'];
            $Patient->last_name_prefix = $name['last_name_prefix'];
            $Patient->surname_prefix = $name['surname_prefix'];
            $Patient->name = $name['name'];
            $Patient->initials = $name['initials'];
            $Patient->type_code = $name['type_code'];

            //address
            $address = $this->getPatientAddress();
            $Patient->address = $address['address'];
            $Patient->street = $address['street'];
            $Patient->city = $address['city'];
            $Patient->postcode = str_replace(" ", "", $address['postcode']);
            $Patient->building_nr = $address['building_nr'];
            $Patient->building_nr_additive = $address['building_nr_additive'];
            $Patient->building_nr_full = $address['building_nr_full'];
            $Patient->country = $address['country'];
            $Patient->address_type = $address['address_type'];
            $Patient->address_valid_start = $address['address_valid_start'];

            if ($address['second_address']) {
                $Patient->second_address = true;
                $address2 = $this->getPatientAddress(1);
                $Patient->address2 = $address2['address'];
                $Patient->street2 = $address2['street'];
                $Patient->city2 = $address2['city'];
                $Patient->postcode2 = str_replace(" ", "", $address2['postcode']);
                $Patient->building_nr2 = $address2['building_nr'];
                $Patient->building_nr_additive2 = $address2['building_nr_additive'];
                $Patient->building_nr_full2 = $address2['building_nr_full'];
                $Patient->country2 = $address2['country'];
                $Patient->address_type2 = $address2['address_type'];
                $Patient->address_valid_start2 = $address2['address_valid_start'];
            }


            $Patient->phones = $this->getPatientPhone();

            $insurance = $this->getPatientInsurance();
            $Patient->policy_nr = $insurance['policy_nr'];
            $Patient->uzovi = $insurance['uzovi'];
            $Patient->insurance_company_name = $insurance['insurance_company_name'];
            $Patient->insurance_company_resource = $insurance['insurance_company_resource'];
            foreach ($this->getPatientIds() as $id) {
                $Patient->setIdentity($id['identifier'], $id['assigningAuthority'], $id['typeCode']);
            }
            $Patient->identities = $this->getPatientIds(); //set BSN and other id's
            $Patient->identities_alternate = $this->getPatientAlternateIds(); //set BSN and other id's
            $Patient->identity_unknown_indicator = $this->getIdentityUnknownIndicator();
            $Patient->identity_reliability_code = $this->getIdentityReliability();
            $Patient->bsn = $this->getBsn();
        }
        return $Patient;
    }

    public function getPatientPhone()
    {
        $find = [".", "-", '  ', ' ', '/'];
        $tel = [];
        $nr = $this->getSegmentNrs('PID', true);
        if ($nr !== false) {
            foreach ($this->tree[$nr][13] as $phone) {

                //if ($phone[2] ?? null == 'PRN' AND $phone[3] ?? null == 'PH') {
                //$tel['home'] = str_replace($find, "", $phone[1]);
                //} elseif ($phone[2] ?? null == 'ORN' AND $phone[3] ?? null == 'CP') {
                //$tel['mobile'] = str_replace($find, "", $phone[1]);
                //}
                $tel[] = str_replace($find, "", $phone[1]);
            }
        }
        return $tel;
    }

    public function getPatientSex()
    {
        $nr = $this->getSegmentNrs('PID', true);
        if ($nr !== false) {
            return $this->getValue($nr, 8);
        }
        return "";
    }

    public function getPatientInsurance()
    {
        $insurance = ['insurance_company_name' => '', 'insurance_company_resource' => '', 'policy_nr' => '', 'uzovi' => ''];

        $nr = $this->getSegmentNrs('IN1', true);
        if ($nr !== false) {
            $insurance['policy_nr'] = $this->getValue($nr, 36);
            $uzovi = $this->getValue($nr, 3, 1);
            if (strlen($uzovi > 2)) {
                $insurance['uzovi'] = $uzovi;
            }
            $insurance['insurance_company_name'] = $this->getValue($nr, 4, 1);
            $insurance['insurance_company_resource'] = $this->getValue($nr, 3, 4, 1);
        }
        return $insurance;
    }

    public function getPatientIds()
    {
        $ids = [];
        $nr = $this->getSegmentNrs('PID', true);
        if ($nr !== false) {
            foreach ($this->tree[$nr][3] as $patIds) {
                if ($patIds[1] ?? false) {
                    $ids[] = ['identifier' => $patIds[1], 'assigningAuthority' => $patIds[4][1] ?? null, 'typeCode' => $patIds[5]];
                }
            }
        }
        return $ids;
    }

    public function getPatientAlternateIds()
    {
        $ids = [];
        $nr = $this->getSegmentNrs('PID', true);
        if ($nr !== false) {
            foreach ($this->tree[$nr][4] as $patIds) {
                if ($patIds[1] ?? false) {
                    $ids[] = ['identifier' => $patIds[1], 'assigningAuthority' => $patIds[4][1] ?? null, 'typeCode' => $patIds[5]];
                }
            }
        }
        return $ids;
    }

    public function getPatientId($authority, $typeCode = "")
    {
        $nr = $this->getSegmentNrs('PID', true);
        if ($nr !== false) {
            foreach ($this->tree[$nr][3] as $patIds) {
                if (($patIds[4][1] ?? null) == $authority) {
                    if ($typeCode)
                        if ($patIds[5] ?? null == $typeCode)
                            return $patIds[1];
                        else {
                            return "";
                        }
                    else {
                        return $patIds[1];
                    }
                }
            }
        }
        return "";
    }

    public function getBsn(): string
    {
        return $this->getPatientId('NLMINBIZA'); //, 'NNNLD'
    }

    public function getZorgdomeinNr()
    {
        return $this->getPatientId('ZorgDomein', 'VN');
    }

    public function getPatientName()
    {
        $names = [];
        $nr = $this->getSegmentNrs('PID', true);
        if ($nr !== false) {
            $names['last_name'] = $this->getValue($nr, 5, 1, 5);
            $names['surname'] = $this->getValue($nr, 5, 1, 3);
            $names['last_name_prefix'] = $this->getValue($nr, 5, 1, 4);
            $names['surname_prefix'] = $this->getValue($nr, 5, 1, 2);
            $names['name'] = $this->getValue($nr, 5, 1, 1);
            //$names['initials'] = str_replace([" ", "."], "", substr($this->getValue($nr, 5, 2), 0, 1) . $this->getValue($nr, 5, 3));
            $names['initials'] = $this->initials($nr);
            $names['type_code'] = $this->getValue($nr, 5, 7);    //L = legal
            if (!strlen($names['surname'])) {
                $names['surname'] = $names['name'];
            }
        }
        return $names;
    }

    private function initials(int $nr): string
    {
        $first_name = str_replace(" ", "", $this->getValue($nr, 5, 2));
        $initials = str_replace(" ", "", $this->getValue($nr, 5, 3));

        if (mb_strlen($first_name) > 1) {

            if (mb_strpos($initials, $first_name) !== false) {
                $initials = trim(str_replace($first_name, "", $initials));
                if ($initials[0] == $first_name[0]) {
                    $initials = mb_substr($initials, 1);
                }
            }

            if (!ctype_upper($first_name[1])) {
                $first_name = mb_substr($first_name, 0, 1);
            }
        }
        return $first_name . $initials;
    }

    public function getPatientDob()
    {
        $nr = $this->getSegmentNrs('PID', true);
        if ($nr !== false) {
            $dob = $this->getValue($nr, 7, 1);
            return $dob ? date_create_from_format("Ymd", $dob)->format("Y-m-d") : '';
        }
        return "";
    }

    public function getPatientAddress($addressnr = 0)
    {

        $address = [];
        $nr = $this->getSegmentNrs('PID', true);
        if ($nr !== false) {
            $address['address'] = $this->getValue($nr, 11, 1, 1, $addressnr);
            $address['street'] = $this->getValue($nr, 11, 1, 2, $addressnr);
            $address['city'] = $this->getValue($nr, 11, 3, 0, $addressnr);
            $address['postcode'] = $this->getValue($nr, 11, 5, 0, $addressnr);
            $address['building_nr'] = $this->getValue($nr, 11, 1, 3, $addressnr);
            $address['building_nr_additive'] = $this->getValue($nr, 11, 2, 0, $addressnr);

            $address['country'] = $this->getValue($nr, 11, 6, 0, $addressnr);
            $address['address_type'] = $this->getValue($nr, 11, 7, 0, $addressnr); //M=mailing, L=legal address BA=bad address

            //HL7 is not always correct formated
            //Parnassia street^buildingnr instead of address^street^buildingnr
            if (!$address['street']) {
                $address['address'] = $address['address'] . " " . $address['building_nr_additive'];
                $s = $this->split_address($address['address']);
                $b = $this->split_buildingnr($address['building_nr_additive']);
                if ($b) {
                    $address['building_nr'] = $b['number'];
                    $address['building_nr_additive'] = $b['addition'];
                } else {
                    $address['building_nr'] = $address['building_nr_additive'];
                }
                $address['street'] = $s['street'];
            }

            if (strlen($address['street']) > strlen($address['address'])) { //address should be larger
                if (strpos($address['street'], $address['building_nr'])) {
                    //street is an address
                    $st = $this->split_address($address['street']);
                    $address['street'] = $st['street'];
                }
            }
            if (!$address['building_nr']) {
                $s = $this->split_address($address['address']);
                $address['street'] = $s['street'];
                if ($s['number']) {
                    $address['building_nr'] = $s['number'];
                }
                if ($s['numberAddition']) {
                    $address['building_nr_additive'] = $s['numberAddition'];
                }
            }

            $address['building_nr_full'] = trim($address['building_nr'] . " " . $address['building_nr_additive']);
            $address['address'] = $address['street'] . " " . $address['building_nr_full'];


            $address['address_valid_start'] = $this->getValue($nr, 11, 12, 1, $addressnr); //address valid from
            //more than one address
            $address['second_address'] = false;
            if ($this->getValue($nr, 11, 1, 1, $addressnr + 1)) {
                $address['second_address'] = true;
            }
        }
        return $address;
    }

    public function getIdentityUnknownIndicator()
    {
        $nr = $this->getSegmentNrs('PID', true);
        if ($nr !== false) {
            return $this->getValue($nr, 31);
        }
        return "";
    }

    public function getIdentityReliability()
    {
        $nr = $this->getSegmentNrs('PID', true);
        if ($nr !== false) {
            return $this->getValue($nr, 32);
        }
        return "";
    }

}