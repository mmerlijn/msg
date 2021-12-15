<?php


namespace mmerlijn\msg\src\repo;


class OrderComment
{
    public $id = '';
    public $type_of_value = '';
    public $identifier_code = '';
    public $identifier_label = '';
    public $identifier_source = '';//99zda=Zorgdomein defined, 99zdl=user defined, else see Table0396

    //external codes
    public $identifier_alternate_code = ''; //wordt in principe niet gebruikt
    public $identifier_alternate_label = ''; //wordt in principe niet gebruikt
    public $identifier_alternate_source = ''; //wordt in principe niet gebruikt

    //Code is dependent of field 2
    public $value = '';
    public $value_code = '';
    public $value_source = '';
    public $units = '';
    public $references_range = '';
    public $abnormal_flags = '';
    public $result_status = 'F'; //F/C
    public $datetime_of_the_observation = '';
    public $equipment_instance_identifier = '';
    public $datetime_of_analysis = '';

    public $repeated = false;
    public $notes = []; //become NTE segments

    public function addOrderNote(OrderNote $note)
    {
        $this->notes[] = $note;
    }
    public function toArray():array
    {
        $response = [
            "id"=>$this->id,
            "type_of_value"=>$this->type_of_value,
            "identifier_code"=>$this->identifier_code,
            "identifier_label"=>$this->identifier_label,
            "identifier_source"=>$this->identifier_source,
            "identifier_alternate_code"=>$this->identifier_alternate_label,
            "identifier_alternate_source"=>$this->identifier_alternate_source,
            "value"=>$this->value,
            "value_code"=>$this->value_code,
            "value_source"=>$this->value_source,
            "units"=>$this->units,
            "references_range"=>$this->references_range,
            "abnormal_flags"=>$this->abnormal_flags,
            "result_status"=>$this->result_status,
            "datetime_of_the_observation"=>$this->datetime_of_the_observation,
            "equipment_instance_identifier"=>$this->equipment_instance_identifier,
            "datetime_of_analysis"=>$this->datetime_of_analysis,
            "notes"=>[]
        ];
            foreach ($this->notes as $note){
                $response['notes'][] = $note->toArray();
            }
        return $response;
    }
}