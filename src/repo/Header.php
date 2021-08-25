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
    public $security="";
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

    public $sender=[
        'name'=>'',
        'agbcode'=>'',
        'source'=>'',
        'buildingnr'=>'',
        'street'=>'',
        'city'=>'',
        'postcode'=>'',
        'country'=>'',
        'phone'=>'',
        'department'=>'',
    ];
    public $receiver=[
        'name'=>'',
        'agbcode'=>'',
        'source'=>'',
        'buildingnr'=>'',
        'street'=>'',
        'city'=>'',
        'postcode'=>'',
        'country'=>'',
        'phone'=>'',
        'department'=>'',
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
}