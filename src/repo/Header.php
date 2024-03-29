<?php


namespace mmerlijn\msg\src\repo;


use mmerlijn\msg\src\Hl7\tools\EncodingChars;

class Header
{
    public $field_separator = "|";
    public $encoding_characters = "^~\&";
    public $sending_application = "";
    public $sending_device = "";
    public $sending_facility = "";
    public $receiving_application = "";
    public $receiving_facility = "";
    public $datetime_of_message = null;
    public $security = "";
    public $message_type_type = "ORM";
    public $message_type_trigger_event = "O01";
    public $message_type_structure = "ORM_O01";
    public $message_control_id = null; //Unique message identifier.
    public $processing_id = 'P';
    public $version_id = '2.4';
    public $country_code = "NLD";
    public $character_set = '8859/1';
    public $sequence_nr = '';
    public $acceptAcknowledgement = '';
    public $applicationAcknowledgement = '';

    public $sender = [
        'name' => '',
        'agbcode' => '',
        'source' => '',
        'buildingnr' => '',
        'street' => '',
        'city' => '',
        'postcode' => '',
        'country' => '',
        'phone' => '',
        'department' => '',
    ];
    public $receiver = [
        'name' => '',
        'agbcode' => '',
        'source' => '',
        'buildingnr' => '',
        'street' => '',
        'city' => '',
        'postcode' => '',
        'country' => '',
        'phone' => '',
        'department' => '',
    ];

    public function __construct()
    {
        $this->field_separator = EncodingChars::getFieldSeparator();
        $this->encoding_characters = EncodingChars::getComponentSeparator() .
            EncodingChars::getRepetitionSeparator() .
            EncodingChars::getEscapeChar() .
            EncodingChars::getSubComponentSeparator();
        $this->version_id = EncodingChars::getVersion();
    }

    public function setCountryCode($value)
    {
        if ($value) {
            $this->country_code = $value;
        }
    }

    public function setVersionId($value)
    {
        if ($value) {
            $this->version_id = $value;
        }
    }

    public function setProcessingId($value)
    {
        if ($value) {
            $this->processing_id = $value;
        }
    }

    public function setCharacterSet($value)
    {
        if ($value) {
            $this->character_set = $value;
        }
    }

    public function toArray(): array
    {
        return [
            "sending_application" => $this->sending_application,
            "sending_device" => $this->sending_device,
            "sending_facility" => $this->sending_facility,
            "receiving_application" => $this->receiving_application,
            "receiving_facility" => $this->receiving_facility,
            "datetime_of_message" => $this->datetime_of_message,
            "security" => $this->security,
            "message_type_type" => $this->message_type_type,
            "message_type_trigger_event" => $this->message_type_trigger_event,
            "message_type_structure" => $this->message_type_structure,
            "message_control_id" => $this->message_control_id,
            "processing_id" => $this->processing_id,
            "version_id" => $this->version_id,
            "country_code" => $this->country_code,
            "character_set" => $this->character_set,
            "sequence_nr" => $this->sequence_nr,
            "acceptAcknowledgement" => $this->acceptAcknowledgement,
            "applicationAcknowledgement" => $this->applicationAcknowledgement,
            "sender" => $this->sender,
            "receiver" => $this->receiver,

        ];
    }
}