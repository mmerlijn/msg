<?php


namespace mmerlijn\msg\src\Hl7\traits;


use mmerlijn\msg\src\repo\Header;

trait SetHeaderTrait
{
    public function setHeader(Header $H): void
    {
        $this->setSendingApplication($H->sending_application);
        $this->setSendingDevice($H->sending_device);
        $this->setSendingFacility($H->sending_facility);
        $this->setValue($H->field_separator, 0, 1);
        $this->setValue($H->encoding_characters, 0, 2);
        $this->setReceivingApplication($H->receiving_application);
        $this->setReceivingFacility($H->receiving_facility);
        $this->setDatetimeOfMessage($H->datetime_of_message);
        $this->setSecurity($H->security);
        $this->setMessageTypeType($H->message_type_type);
        $this->setMessageTypeTriggerEvent($H->message_type_trigger_event);
        $this->setMessageTypeStructure($H->message_type_structure);
        $this->setMessageControlId($H->message_control_id);
        $this->setProcessingId($H->processing_id);
        $this->setVersionId($H->version_id);
        $this->setCountryCode($H->country_code);
        $this->setCharacterSet($H->character_set);
        $this->setSequenceNr($H->sequence_nr);
        $this->setAcceptAcknowledgement($H->acceptAcknowledgement);
        $this->setApplicationAcknowledgement($H->applicationAcknowledgement);
    }

    public function setSendingApplication($value): void
    {
        $nr = $this->getSegmentNrs('MSH', true, true);
        $this->setValue($value, $nr, 3, 1);
    }

    public function setSendingDevice(string $value): void
    {
        $this->setValue($value, 0, 3, 2);
    }

    public function setSendingFacility(string $value): void
    {
        $this->setValue($value, 0, 4, 1);
    }

    public function setReceivingApplication(string $value): void
    {
        $this->setValue($value, 0, 5, 1);
    }

    public function setReceivingFacility($value): void
    {
        $this->setValue($value, 0, 6, 1);
    }
    public function setSecurity($value): void
    {
        $this->setValue($value, 0, 8);
    }
    public function setDatetimeOfMessage(string $value = null): void
    {
        if ($value !== null) {
            try {
                $datetime = date_create_from_format("Y-m-d H:i:s", $value)->format($this->dateTimeFormatOut);
                $this->setValue($datetime, 0, 7, 1);
            } catch (\Exception $e) {
                throw new \Exception("Error setDatetimeOfMessage not proper format expect Y-m-d H:i:s got {$value}");
            }
        } else {
            $this->setValue(date($this->dateTimeFormatOut), 0, 7, 1);
        }
    }

    public function setMessageType(string $type)
    {
        switch ($type) {
            case "ORM":
                $this->setValue("ORM", 0, 9, 1);
                $this->setValue("O01", 0, 9, 2);
                $this->setValue("ORM_O01", 0, 9, 3);
                break;
            case "ORU":
                $this->setValue("ORU", 0, 9, 1);
                $this->setValue("R01", 0, 9, 2);
                //$this->setValue("ORU_R01", 0, 9, 3);
                $this->setValue("", 0, 9, 3);
                break;
        }
    }

    public function setMessageTypeType(string $value): void
    {
        $this->setValue($value, 0, 9, 1);
    }

    public function setMessageTypeTriggerEvent(string $value): void
    {
        $this->setValue($value, 0, 9, 2);
    }

    public function setMessageTypeStructure(string $value): void
    {
        $this->setValue($value, 0, 9, 3);
    }

    public function setMessageControlId($value = null): void
    {
        if ($value !== null) {
            $this->setValue($value, 0, 10);
        } else {
            //20 hex lange time + random code (uniek)
            $this->setValue(dechex(time()) . bin2hex(random_bytes(6)), 0, 10);
        }
    }

    public function setProcessingId(string $value = null): void
    {
        if ($value !== null) {
            $this->setValue($value, 0, 11, 1);
        } else {
            $this->setValue("P", 0, 11, 1);
        }
    }

    public function setVersionId(string $value = null): void
    {
        if ($value !== null) {
            $this->setValue($value, 0, 12, 1);
        } else {
            $this->setValue("2.4", 0, 12, 1);
        }

    }

    public function setCountryCode(string $value = null): void
    {
        if ($value !== null) {
            $this->setValue($value, 0, 17);
        } else {
            $this->setValue("NLD", 0, 17);
        }

    }

    public function setCharacterSet(string $value = null): void
    {
        if ($value !== null) {
            $this->setValue($value, 0, 18);
        } else {
            $this->setValue("8859/1", 0, 18);
        }

    }

    public function setSequenceNr(string $value = null): void
    {
        $this->setValue($value, 0, 13);
    }

    public function setAcceptAcknowledgement(string $value): void
    {
        $this->setValue($value, 0, 15);
    }

    public function setApplicationAcknowledgement(string $value): void
    {
        $this->setValue($value, 0, 16);
    }
}