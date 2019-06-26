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

        $address = $this->getPatientAddress();
        $Patient->address = $address['address'];
        $Patient->street = $address['street'];
        $Patient->city = $address['city'];
        $Patient->postcode = $address['postcode'];
        $Patient->building_nr = $address['building_nr'];
        $Patient->building_nr_additive = $address['building_nr_additive'];
        $Patient->building_nr_full = $address['building_nr_full'];
        $Patient->country = $address['country'];
        $Patient->address_type = $address['address_type'];

        $Patient->phones = $this->getPatientPhone();

        $insurance = $this->getPatientInsurance();
        $Patient->policy_nr = $insurance['policy_nr'];
        $Patient->uzovi = $insurance['uzovi'];
        $Patient->insurance_company_name = $insurance['insurance_company_name'];
        $Patient->insurance_company_resource = $insurance['insurance_company_resource'];
        foreach ($this->getPatientIds() as $id){
            $Patient->setIdentity($id['identifier'], $id['assigningAuthority'], $id['typeCode']);
        }
        $Patient->identities = $this->getPatientIds(); //set BSN and other id's
        $Patient->identity_unknown_indicator = $this->getIdentityUnknownIndicator();
        $Patient->identity_reliability_code = $this->getIdentityReliability();
        return $Patient;
    }
    public function getPatientPhone()
    {
        $find = [".", "-", '  ', ' ', '/'];
        $tel = [];
        $nr = $this->getSegmentNrs('PID', true);
        if ($nr !== false) {
            foreach (static::$tree[$nr][13] as $phone) {

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
        $insurance = ['insurance_company_name'=>'','insurance_company_resource'=>'','policy_nr'=>'','uzovi'=>''];

        $nr = $this->getSegmentNrs('IN1', true);
        if ($nr !== false) {
            $insurance['policy_nr'] = $this->getValue($nr, 36);
            $uzovi = $this->getValue($nr, 3, 1);
            if (strlen($uzovi > 2)) {
                $insurance['uzovi'] = $uzovi;
            }
            $insurance['insurance_company_name'] = $this->getValue($nr, 4, 1);
            $insurance['insurance_company_resource'] = $this->getValue($nr, 3,4,1);
        }
        return $insurance;
    }
    public function getPatientIds()
    {
        $ids=[];
        $nr = $this->getSegmentNrs('PID', true);
        if ($nr !== false) {
            foreach (static::$tree[$nr][3] as $patIds) {
                if($patIds[1]??false){
                $ids[] = ['identifier' => $patIds[1], 'assigningAuthority' => $patIds[4][1] ?? null, 'typeCode' => $patIds[5]];
                }
            }
        }
        return $ids;
    }
    public function getPatientId($authority, $identifier)
    {
        $nr = $this->getSegmentNrs('PID', true);
        if ($nr !== false) {
            foreach (static::$tree[$nr][3] as $patIds) {
                if ($patIds[4][1] ?? null == $authority AND $patIds[5] ?? null == $identifier) {
                    return $patIds[1];
                }
            }
        }
        return "";
    }
    public function getBsn(): string
    {
        return $this->getPatientId('NLMINBIZA', 'NNNLD');
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
            $names['initials'] = str_replace([" ", "."], "", substr($this->getValue($nr, 5, 2),0,1) . $this->getValue($nr, 5, 3));
            $names['type_code'] = $this->getValue($nr, 5, 7);    //L = legal
        }
        return $names;
    }

    public function getPatientDob()
    {
        $nr = $this->getSegmentNrs('PID', true);
        if ($nr !== false) {
            $dob = $this->getValue($nr, 7,1);
            return $dob ? date_create_from_format("Ymd", $dob)->format("Y-m-d"):'';
        }
        return "";
    }

    public function getPatientAddress()
    {
        $address = [];
        $nr = $this->getSegmentNrs('PID', true);
        if ($nr !== false) {
            $address['address'] = $this->getValue($nr, 11, 1, 1);
            $address['street'] = $this->getValue($nr, 11, 1, 2);
            $address['city'] = $this->getValue($nr, 11, 3);
            $address['postcode'] = $this->getValue($nr, 11, 5);
            $address['building_nr'] = $this->getValue($nr, 11, 1, 3);
            $address['building_nr_additive'] = $this->getValue($nr, 11, 2);
            $address['building_nr_full'] = trim($address['building_nr'] . " " . $address['building_nr_additive']);
            $address['country'] = $this->getValue($nr, 11, 6);
            $address['address_type'] = $this->getValue($nr, 11, 7); //M=mailing, L=legal address BA=bad address
        }
        return $address;
    }
    public function getIdentityUnknownIndicator()
    {
        $nr = $this->getSegmentNrs('PID',true);
        if ($nr !== false) {
            return $this->getValue($nr, 31);
        }
        return "";
    }
    public function getIdentityReliability()
    {
        $nr = $this->getSegmentNrs('PID',true);
        if ($nr !== false) {
            return $this->getValue($nr, 32);
        }
        return "";
    }
}