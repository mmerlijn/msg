<?php


namespace mmerlijn\msg\src\Hl7\traits;


use mmerlijn\msg\src\repo\Header;

Trait GetHeaderTrait
{
    public function getHeader()
    {
        $H = new Header();
        $H->sending_application = $this->getSendingApplication();
        $H->sending_device = $this->getSendingDevice();
        $H->sending_facility = $this->getSendingFacility();
        $H->receiving_application = $this->getReceivingApplication();
        $H->receiving_facility = $this->getReceivingFacility();
        $H->datetime_of_message = $this->getDatetimeOfMessage();
        $H->security = $this->getSecurity();
        $H->message_type_type = $this->getMessageTypeType();
        $H->message_type_trigger_event = $this->getMessageTypeTriggerEvent();
        $H->message_type_structure = $this->getMessageTypeStructure();
        $H->message_control_id = $this->getMessageControlId();
        $H->setProcessingId($this->getProcessingId());
        $H->setCountryCode($this->getCountryCode());
        $H->setCharacterSet($this->getCharacterSet());
        $H->setVersionId($this->getVersionId());
        $H->sequence_nr = $this->getSequenceNr();
        $H->acceptAcknowledgement = $this->getAcceptAcknowledgement();
        $H->applicationAcknowledgement = $this->getApplicationAcknowledgement();
        return $H;
    }

    public function getSendingApplication()
    {
        return $this->getValue(0, 3, 1);
    }

    public function getSendingDevice()
    {
        return $this->getValue(0, 3, 2);
    }

    public function getSendingFacility()
    {
        return $this->getValue(0, 4, 1);
    }

    public function getReceivingApplication()
    {
        return $this->getValue(0, 5, 1);
    }

    public function getReceivingFacility()
    {
        return $this->getValue(0, 6, 1);
    }

    public function getDatetimeOfMessage()
    {
        $datetime = $this->getValue(0, 7, 1);
        return $this->setDatetimeFormat($datetime, 'MSH', 7);
    }

    public function getSecurity(){
        return $this->getValue(0, 8);
    }
    public function getMessageTypeType()
    {
        return $this->getValue(0, 9, 1);
    }

    public function getMessageTypeTriggerEvent()
    {
        return $this->getValue(0, 9, 2);
    }

    public function getMessageTypeStructure()
    {
        return $this->getValue(0, 9, 3);
    }

    public function getMessageControlId()
    {
        return $this->getValue(0, 10);
    }

    public function getProcessingId()
    {
        return $this->getValue(0, 11, 1);
    }

    public function getVersionId()
    {
        return $this->getValue(0, 12, 1);
    }

    public function getCountryCode()
    {
        return $this->getValue(0, 17);
    }

    public function getCharacterSet()
    {
        return $this->getValue(0, 18);
    }

    public function getSequenceNr()
    {
        return $this->getValue(0, 13);
    }

    public function getAcceptAcknowledgement()
    {
        return $this->getValue(0, 15);
    }

    public function getApplicationAcknowledgement()
    {
        return $this->getValue(0, 16);
    }
}