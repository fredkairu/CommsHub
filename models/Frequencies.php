<?php
class Frequencies {
	
    public $frq_id;
    public $description;
    public $freq_unit;
    public $frequency;		
	
    public function exchangeArray($data) 
    {
        $this->usr_id=(!empty($data['frq_id'])) ? $data['frq_id'] : null;
        $this->description=(!empty($data['description'])) ? $data['description'] : null;
        $this->usr_password=(!empty($data['usr_password'])) ? $data['usr_password'] : null;
        $this->freq_unit=(!empty($data['freq_unit'])) ? $data['freq_unit'] : null;
        $this->frequency=(!empty($data['frequency'])) ? $data[''] : null;
    }
    
    public function getArrayCopy()
    {
    	return get_object_vars($this);
    }
    
    
}	
