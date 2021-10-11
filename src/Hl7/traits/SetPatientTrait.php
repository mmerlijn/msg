<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 20:32
 */

namespace mmerlijn\msg\src\Hl7\traits;

use mmerlijn\msg\src\Hl7\fields\CX;
use mmerlijn\msg\src\repo\Patient;

trait SetPatientTrait
{
    public function setPatient(Patient $P)
    {
        $this->deleteCurrentPatient();

        $this->setPIDId();
        foreach ($P->phones as $phone) {
            if ($phone) {
                $this->setPatientPhone($phone);
            }
        }
        $this->setPatientSex($P->sex);
        $this->setPatientDob($P->dob);
        $this->setPatientInsurance($P->policy_nr, $P->uzovi, $P->insurance_company_name);
        $this->unsetPatientIds();
        $this->unsetPatientAlternateIds();

        $this->setPatientIds($P->identities);
        $this->setPatientAlternateIds($P->identities_alternate);
        if ($P->bsn) {
            $this->setBsn($P->bsn);
        }
        $this->setPatientName([
            'last_name' => $P->last_name,
            'last_name_prefix' => $P->last_name_prefix,
            'surname' => $P->surname,
            'surname_prefix' => $P->surname_prefix,
            'name' => $P->name,
            'initials' => $P->initials,
        ]);
        $this->setPatientAddress([
            'address' => $P->address,
            'street' => $P->street,
            'city' => $P->city,
            'postcode' => $P->postcode,
            'building_nr' => $P->building_nr,
            'building_nr_full' => $P->building_nr_full,
            'building_nr_additive' => $P->building_nr_additive,
            'country' => $P->country,
            'address_type' => $P->address_type,
            'address_valid_start' => $P->address_valid_start
        ]);

        if ($P->second_address) {
            $this->setPatientAddress([
                'address' => $P->address2,
                'street' => $P->street2,
                'city' => $P->city2,
                'postcode' => $P->postcode2,
                'building_nr' => $P->building_nr2,
                'building_nr_full' => $P->building_nr_full2,
                'building_nr_additive' => $P->building_nr_additive2,
                'country' => $P->country2,
                'address_type' => $P->address_type2,
                'address_valid_start' => $P->address_valid_start2
            ], 1);
        }
        $this->setPatientIdentityUnknown($P->identity_unknown_indicator);
        $this->setPatientReliabilityCode($P->identity_reliability_code);
    }

    private function deleteCurrentPatient()
    {
        $nr = $this->getSegmentNrs('PID', true);
        if ($nr !== false) {
            unset($this->tree[$nr]);
        }
        $nr = $this->getSegmentNrs('IN1', true);
        if ($nr !== false) {
            unset($this->tree[$nr]);
        }
        $this->tree = array_values($this->tree); ///array keys reset
    }

    public function setPatientPhone(string $data): void
    {
        $nr = $this->getSegmentNrs('PID', true, true);
        $found = false;
        $empty = true;

        if ($nr !== false) {
            foreach ($this->tree[$nr][13] as $i => $phone) {

                if (!($phone[1] ?? null)) {
                    $empty = false;
                }
                if ($phone[1] == $data) {
                    //already exist
                    $found = true;
                }
            }
            if (!$found) {
                if ($empty) {
                    $new_nr = $this->addRepeatField($nr, 13);
                } else {
                    $new_nr = 0;
                }
                if (substr($data, 0, 2) == "06") {
                    $this->tree[$nr][13][$new_nr][1] = $data;
                    $this->tree[$nr][13][$new_nr][2] = 'PNR';
                    $this->tree[$nr][13][$new_nr][3] = 'CP';
                } else {
                    $this->tree[$nr][13][$new_nr][1] = $data;
                    $this->tree[$nr][13][$new_nr][2] = 'PNR';
                    $this->tree[$nr][13][$new_nr][3] = 'PH';
                }
            }
        }
    }

    public function setPatientSex(string $value): void
    {
        $nr = $this->getSegmentNrs('PID', true, true);
        if ($nr !== false) {
            $this->setValue($value, $nr, 8);
        }
    }

    public function setPIDId(): void
    {
        $nr = $this->getSegmentNrs('PID', true, true);
        if ($nr !== false) {
            $this->setValue(1, $nr, 1);
        }
    }

    public function setPatientDob(string $value): void
    {
        $nr = $this->getSegmentNrs('PID', true, true);
        if ($nr !== false and $value) {
            $datetime = date_create_from_format("Y-m-d", $value)->format("Ymd");
            $this->setValue($datetime, $nr, 7, 1);
        }
    }

    public function setPatientInsurance($policy_nr, $uzovi, $insurance_company): void
    {
        if ($policy_nr) {
            $nr = $this->getSegmentNrs('IN1', true, true);
            $this->setValue(1, $nr, 1);
            if ($nr !== false) {
                if ($policy_nr) {
                    $this->setValue("null", $nr, 2, 2);
                }
                $this->setValue($policy_nr, $nr, 36);
                $this->setValue($uzovi, $nr, 3, 1);
                if ($uzovi) {
                    $this->setValue("VEKTIS", $nr, 3, 4, 1);
                    $this->setValue("UZOVI", $nr, 3, 5);
                } elseif ($insurance_company) {
                    $this->setValue("LOCAL", $nr, 3, 4, 1);
                }
                $this->setValue($insurance_company, $nr, 4, 1);
            }
        }
    }

    public function setPatientIds($ids): void
    {
        $nr = $this->getSegmentNrs('PID', true, true);
        foreach ($ids as $t => $id) {
            if (!isset($this->tree[$nr][3][$t])) {
                $new_nr = $this->addRepeatField($nr, 3);
            } else {
                $new_nr = $t;
            }
            $this->tree[$nr][3][$new_nr][1] = $id['identifier'];
            $this->tree[$nr][3][$new_nr][4][1] = $id['assigningAuthority'];
            $this->tree[$nr][3][$new_nr][5] = $id['typeCode'];
        }
    }

    public function setPatientAlternateIds($ids): void
    {

        $nr = $this->getSegmentNrs('PID', true, true);
        foreach ($ids as $t => $id) {
            if (!isset($this->tree[$nr][4][$t])) {
                $new_nr = $this->addRepeatField($nr, 3);
            } else {
                $new_nr = $t;
            }
            $this->tree[$nr][4][$new_nr][1] = $id['identifier'];
            $this->tree[$nr][4][$new_nr][4][1] = $id['assigningAuthority'];
            $this->tree[$nr][4][$new_nr][5] = $id['typeCode'];
        }
    }
    public function unsetPatientAlternateIds()
    {
        $nr = $this->getSegmentNrs('PID', true, true);
        if ($nr !== false) {
            $this->tree[$nr][4] = [CX::setEmpty()];
        }
    }
    public function unsetPatientIds()
    {
        $nr = $this->getSegmentNrs('PID', true, true);
        if ($nr !== false) {
            $this->tree[$nr][3] = [CX::setEmpty()];
        }
    }

    public function setPatientId(string $id, string $authority, string $identifier): void
    {
        $nr = $this->getSegmentNrs('PID', true, true);
        $found = false;
        $empty = true;
        if ($nr !== false) {
            foreach ($this->tree[$nr][3] as $i => $patIds) {
                if (!($patIds[1] ?? null)) {
                    $empty = false;
                }
                if (($patIds[4][1] ?? null) == $authority AND ($patIds[1] ?? null) == $id) {
                    //already exist
                    $this->tree[$nr][3][$i][1] = $id;
                    $found = true;
                    if($authority== "NLMINBIZA"){
                        $this->tree[$nr][3][$i][5] = "NNNLD";
                    }
                }
            }
            if (!$found) {
                if ($empty) {
                    $new_nr = $this->addRepeatField($nr, 3);
                } else {
                    $new_nr = 0;
                }
                $this->tree[$nr][3][$new_nr][1] = $id;
                $this->tree[$nr][3][$new_nr][4][1] = $authority;
                $this->tree[$nr][3][$new_nr][5] = $identifier;
            }
        }
    }
    public function setPatientAlternateId(string $id, string $authority, string $identifier): void
    {
        $nr = $this->getSegmentNrs('PID', true, true);
        $found = false;
        $empty = true;
        if ($nr !== false) {
            foreach ($this->tree[$nr][4] as $i => $patIds) {
                if (!($patIds[1] ?? null)) {
                    $empty = false;
                }
                if (($patIds[4][1] ?? null) == $authority AND ($patIds[5] ?? null) == $identifier) {
                    //already exist
                    $this->tree[$nr][4][$i][1] = $id;
                    $found = true;
                }
            }
            if (!$found) {
                if ($empty) {
                    $new_nr = $this->addRepeatField($nr, 4);
                } else {
                    $new_nr = 0;
                }
                $this->tree[$nr][4][$new_nr][1] = $id;
                $this->tree[$nr][4][$new_nr][4][1] = $authority;
                $this->tree[$nr][4][$new_nr][5] = $identifier;
            }
        }
    }
    public function setBsn(string $bsn): void
    {
        $this->setPatientId($bsn, 'NLMINBIZA', 'NNNLD');
    }

    public function setZorgdomeinNr(string $zdnr): void
    {
        $this->setPatientId($zdnr, 'ZorgDomein', 'VN');
    }

    public function setParnassiaNr(string $nr): void
    {
        $this->setPatientId($nr, 'PIN', 'PT');
    }


    public function setPatientName($name): void
    {
        $nr = $this->getSegmentNrs('PID', true, true);
        if ($nr !== false) {
            $this->setValue((string)$name['last_name'], $nr, 5, 1, 5);
            $this->setValue((string)$name['surname'], $nr, 5, 1, 3);
            $this->setValue((string)$name['last_name_prefix'], $nr, 5, 1, 4);
            $this->setValue((string)$name['surname_prefix'], $nr, 5, 1, 2);

            $this->setValue($this->formatName($name['surname'], $name['last_name'], $name['surname_prefix'], $name['last_name_prefix']), $nr, 5, 1, 1); //name
            if (isset($name['initials'])) {
                $name['initials'] = str_replace([".", " "], "", (string)$name['initials']);
                $this->setValue(substr($name['initials'], 0, 1), $nr, 5, 2);
                if (strlen($name['initials']) > 1) {
                    $this->setValue(substr($name['initials'], 1), $nr, 5, 3);
                } else {
                    $this->setValue("", $nr, 5, 3);
                }
            }
            $this->setValue("L", $nr, 5, 7);
        }
    }

    public function setPatientAddress($address, $addressnr = 0): void
    {
        $nr = $this->getSegmentNrs('PID', true, true);
        if ($nr !== false) {
            if ($addressnr > 0 AND !$this->getField('PID', 11, 3, 0, $addressnr)) {
                $this->addRepeatField($nr, 11);
            }
            if($address['building_nr_full']) {
                $b= $this->split_buildingnr($address['building_nr_full']);
                if($b){
                    $address['building_nr'] = $b['number'];
                    $address['building_nr_additive'] = $b['addition'];
                }else{
                    $address['building_nr'] = $address['building_nr_full'];
                }

            }elseif($address['building_nr']){
                $b = $this->split_buildingnr($address['building_nr']);
                if($b){
                    $address['building_nr'] = $b['number'];
                    if($b['addition'] and !$address['building_nr_additive']){
                        $address['building_nr_additive'] = $b['addition'];
                    }
                }
                $address['building_nr_full'] = trim($address['building_nr'].' '.$address['building_nr_additive']);
            }else{
                $st = $this->split_address($address['street']);
                $address['street'] = $st['street'];
                $address['building_nr'] = $st['number'];
                $address['building_nr_additive'] = $st['numberAddition'];
                $address['building_nr_full'] = trim($address['building_nr'].' '.$address['building_nr_additive']);
            }
            $this->setValue((string)$address['building_nr'], $nr, 11, 1, 3, $addressnr);
            $this->setValue((string)($address['street'] ?? ''), $nr, 11, 1, 2, $addressnr);
            $this->setValue(trim($address['street'] . " " . $address['building_nr_full']), $nr, 11, 1, 1, $addressnr); //address
            $this->setValue((string)($address['city'] ?? ''), $nr, 11, 3, 0, $addressnr);
            $this->setValue((string)($address['postcode'] ?? ''), $nr, 11, 5, 0, $addressnr);
            $this->setValue((string)($address['building_nr_additive'] ?? ''), $nr, 11, 2, 0, $addressnr);
            $this->setValue((string)($address['country'] ?? ''), $nr, 11, 6, 0, $addressnr);
            $this->setValue((string)$address['address_type'] ?? "H", $nr, 11, 7, 0, $addressnr);
            $this->setValue((string)$address['address_valid_start'] ?? "", $nr, 11, 12, 1, $addressnr);
        }
    }


    public function setPatientIdentityUnknown(string $value): void
    {
        $nr = $this->getSegmentNrs('PID', true, true);
        if ($nr !== false) {
            $this->setValue($value, $nr, 31);
        }
    }

    public function setPatientReliabilityCode(string $value): void
    {
        $nr = $this->getSegmentNrs('PID', true, true);
        if ($nr !== false) {
            $this->setValue($value, $nr, 32);
        }
    }

    private function formatName($surname, $lastname, $surname_pref, $lastname_pref)
    {
        $name = '';
        if ($lastname) {
            $name .= trim($lastname_pref . " " . $lastname) . " -";
        }
        $name .= " " . trim($surname_pref . " " . $surname);

        return trim($name);
    }


}